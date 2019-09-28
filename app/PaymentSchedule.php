<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\LoanPayroll;

class PaymentSchedule extends Model
{
	protected $guarded = [];
	
	public function payment_schedules()
    {
        return $this->belongsTo(LoanPayroll::class, 'loan_payroll_id');
    }
}
