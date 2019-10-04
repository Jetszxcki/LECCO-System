<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\TransactionDetail;

class Account extends Model
{
    // scopes
	public function scopeNames($query)
	{
		return $query->select('id', 'account_code');
	}
    
    public function transaction_details()
    {
    	return $this->hasMany(TransactionDetail::class, 'account_code');
    }

    public function parent_account()
    {
    	return $this->hasOne($this, 'account_code');
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
}
