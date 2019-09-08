<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class AccessRight extends Model
{
	protected $guarded = [];

    public function scopeColumnNames($query) 
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
