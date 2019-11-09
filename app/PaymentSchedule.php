<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\LoanPayroll;

class PaymentSchedule extends Model
{
	protected $guarded = [];
	
	public function loan_payroll()
    {
        return $this->belongsTo(LoanPayroll::class, 'loan_payroll_id');
    }

    public function getTotalPaymentAttribute() {
        return round($this->attributes['total_payment'], 2);
    }

    public function getInterestAttribute() {
        return round($this->attributes['interest'], 2);
    }

    public function getPrincipalPaymentAttribute() {
        return round($this->attributes['principal_payment'], 2);
    }

    public function getRemainingPrincipalAttribute() {
        return round($this->attributes['remaining_principal'], 2);
    }

    public function getExpectedPaymentDateAttribute() {
        return substr($this->attributes['expected_payment_date'], 0, 10);
    }
}

