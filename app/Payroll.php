<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Loan;

class Payroll extends Model
{
	protected $guarded = [];

    public function scopeNames($query)
    {
    	return $query->select('id', 'name');
    }
	
	public function loans()
	{
		return $this->belongsToMany(Loan::class, 'loans_payrolls');
	}
}
