<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

use App\Member;
use App\LoanType;
use App\Payroll;
use App\LoanPayroll;
use App\PaymentSchedule;

class Loan extends Model
{
    protected $guarded = [];
	
    public function member()
    {
    	return $this->belongsTo(Member::class);
    }

    public function loan_type_object()
    {
    	return $this->hasOne(LoanType::class, 'id', 'loan_type');
    }
	
	public function payrolls()
	{
		return $this->belongsToMany(Payroll::class, 'loans_payrolls')->withPivot('id')->using(LoanPayroll::class)->orderBy('payroll_id');
	}
	
	public function getNextPaymentScheduleAttribute()
	{
		$payrolls = $this->payrolls()->get();
		$next_per_payroll = collect();
		
		// gets next term to pay in a payroll then push to $next_per_payroll
		foreach($payrolls as $payroll){
			$buff = $payroll->pivot->payment_schedules()->get();
			$buff = $buff->where('actual_payment_date', null);
			if(!$buff->isEmpty()){
				$min_term = $buff->min('term');
				$next_per_payroll->push($buff->firstWhere('term', $min_term));
			}
		}
		
		// Note: do not interchange lines
		if(!$next_per_payroll->isEmpty()){
			$min_term = $next_per_payroll->min('term');
			$next_per_payroll = $next_per_payroll->where('term', $min_term);
			$max_remaining = $next_per_payroll->max('remaining_principal');
			return $next_per_payroll->firstWhere('remaining_principal', $max_remaining);
		}
		
		return null;
	}
	
	public function getLastPaymentScheduleAttribute()
	{
		$payrolls = $this->payrolls()->get();
		$last_per_payroll = collect();
		
		// gets previous term to paid in a payroll then push to $last_per_payroll
		foreach($payrolls as $payroll){
			$buff = $payroll->pivot->payment_schedules()->get();
			$buff = $buff->where('actual_payment_date', !null);
			if(!$buff->isEmpty()){
				$max_term = $buff->max('term');
				$last_per_payroll->push($buff->firstWhere('term', $max_term));
			}
		}
		
		// Note: do not interchange lines
		if(!$last_per_payroll->isEmpty()){
			$max_term = $last_per_payroll->max('term');
			$last_per_payroll = $last_per_payroll->where('term', $max_term);
			$min_remaining = $last_per_payroll->min('remaining_principal');
			return $last_per_payroll->firstWhere('remaining_principal', $min_remaining);
		}
		
		return null;
	}
	
	public function getRemainingPrincipalAttribute(){
		//(no last payment) -> (all payment_schedule.actual_payment_date for the loan is NULL) -> (remaining_principal == amount)
		if(!$this->getLastPaymentScheduleAttribute()){
			return $this->amount;
		}
		return $this->getLastPaymentScheduleAttribute()->remaining_principal;
	}

    public function getColumnNameForView($column)
	{
		return ucwords(str_replace('_', ' ', $column));
	}
	
	public static function createWithRelationships($loan_data, $payrolls_data, $payment_schedule){
		DB::beginTransaction();
    	$loan = Loan::create($loan_data);
		
		#sync is safer than attach : https://stackoverflow.com/a/24706638
		$loan->payrolls()->sync($payrolls_data['payrolls']);
		$payrolls = $loan->payrolls()->get();
		for($term = 1; $term <= $loan->term; $term++){
			$payroll_index = 0;
			foreach($payrolls as $payroll){
				#https://laracasts.com/discuss/channels/eloquent/get-id-of-row-in-pivot-table
				$payroll = $payroll->pivot; //must use pivot row of loans-payrolls. will give payroll row if not.
				$payment_schedule[$term-1][$payroll_index]["term"] = $term;
				$payment_schedule[$term-1][$payroll_index]["total_payment"] = floatval($payment_schedule[$term-1][$payroll_index]["total_payment"]);
				$payment_schedule[$term-1][$payroll_index]["interest"] = floatval($payment_schedule[$term-1][$payroll_index]["interest"]);
				$payment_schedule[$term-1][$payroll_index]["principal_payment"] = floatval($payment_schedule[$term-1][$payroll_index]["principal_payment"]);
				
				$payment_schedule[$term-1][$payroll_index]["remaining_principal"] = floatval($payment_schedule[$term-1][$payroll_index]["remaining_principal"])<0.01?0:floatval($payment_schedule[$term-1][$payroll_index]["remaining_principal"]);
				# https://laravel.com/docs/5.1/eloquent-relationships#inserting-related-models
				$payroll->payment_schedules()->create($payment_schedule[$term-1][$payroll_index]);
				
				$payroll_index = $payroll_index+1;
			}
		}
		DB::commit();
	}
	
	// this is a recommended way to declare event handlers
	public static function boot() {
		parent::boot();

		static::deleting(function($loan) { // before delete() method call this
			// cleanup relationships (LOL)
			DB::beginTransaction();
			$payrolls = $loan->payrolls()->get();
			foreach($payrolls as $payroll){
				$payroll = $payroll->pivot->payment_schedules()->delete();
			}
			$loan->payrolls()->detach();
			DB::commit();
		});
	}
}
