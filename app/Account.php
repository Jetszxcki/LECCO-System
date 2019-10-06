<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\TransactionDetail;

class Account extends Model
{   
    protected $guarded = [];
    
    // scopes
	public function scopeMain($query)
	{
		return $query->where('parent_account', 'none')->first();
	}

    // accessors
    public function getFullAccountNameAttribute()
    {
        return "{$this->account_code} ({$this->name})";
    }
    
    public function transaction_details()
    {
    	return $this->hasMany(TransactionDetail::class, 'account_code');
    }

    public function parent()
    {
    	return $this->hasOne(Account::class, 'account_code', 'parent_account');
    }
    
    public function children()
    {
        return $this->hasMany(Account::class, 'parent_account', 'account_code');
    }
    
    // other functions
	public function getColumnNameForView($column)
	{
		return ucwords(str_replace('_', ' ', $column));
	}

    public function hasChildren()
    {
        return count($this->children) != 0;
    }
}
