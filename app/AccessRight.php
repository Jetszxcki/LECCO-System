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

    public function getOrigColumnName($column)
    {
        return strtolower(str_replace(' ', '_', $column));
    }

    public function hasPrefix($prefix, $access_right)
    {
        return strpos($access_right, $this->getOrigColumnName(strtolower($prefix))) !== false;
    }

    public function toSuffix($access_right)
    {
        if (strpos($access_right, 'list') !== false) {
            return 'View List';
        }
        else if (strpos($access_right, 'view') !== false ||
            strpos($access_right, 'create') !== false ||
            strpos($access_right, 'edit') !== false ||
            strpos($access_right, 'delete') !== false) 
        {
            $words_arr = explode('_', $access_right);
            return ucwords($words_arr[count($words_arr) - 1]);
        } 

        return $this->getColumnNameForView($access_right);
    }

    public function getColumnNameForView($column)
    {
        return ucwords(str_replace('_', ' ', $column));
    }
}
