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
}
