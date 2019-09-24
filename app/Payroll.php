<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Loan;

class Payroll extends Model
{
	public function loans()
	{
		return $this->belongsToMany(Loan::class);
	}
}
