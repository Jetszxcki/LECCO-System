<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Member;
use App\LoanType;
use App\Payroll;
use App\LoanPayroll;

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
		return $this->belongsToMany(Payroll::class, 'loans_payrolls')->withPivot('id')->using(LoanPayroll::class);
	}

    public function getColumnNameForView($column)
	{
		return ucwords(str_replace('_', ' ', $column));
	}
	
}
