<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Loan;

class LoanType extends Model
{
    protected $guarded = [];

    public function scopeNames($query)
    {
    	return $query->select('id', 'name');
    }

    public function scopeInterests($query)
    {
        return $query->select('id', 'interest_per_annum');
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function getColumnNameForView($column)
    {
        return ucwords(str_replace('_', ' ', $column));
    }
}
