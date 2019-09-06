<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
	protected $guarded = [];

	// accessors
	public function getFullNameAttribute()
	{
	    return "{$this->first_name} {$this->last_name}";
	}

	// scopes
	public function scopeNames($query)
	{
		return $query->select('id', 'first_name', 'last_name');
	}

	public function scopeColumnNames($query) {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

	// other functions
	public function getColumnNameForView($column)
	{
		return ucwords(str_replace('_', ' ', $column));
	}
}
