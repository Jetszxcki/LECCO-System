<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

use App\PaymentSchedule;

class LoanPayroll extends Pivot
{
	protected $table = 'loans_payrolls';
	
    public function payment_schedules()
    {
        return $this->hasMany(PaymentSchedule::class, 'loan_payroll_id');
    }
}
