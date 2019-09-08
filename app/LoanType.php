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

    public function scopeColumnNames($query) {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
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
