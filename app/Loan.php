<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Member;
use App\LoanType;

class Loan extends Model
{
    protected $guarded = [];

    public function member()
    {
    	return $this->belongsTo(Member::class);
    }

    public function loan_types()
    {
    	return $this->hasMany(LoanType::class);
    }

    public function getColumnNameForView($column)
	{
		return ucwords(str_replace('_', ' ', $column));
	}
}
