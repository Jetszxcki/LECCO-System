<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\TransactionDetail;

class Account extends Model
{
    public function transaction_details()
    {
    	return $this->hasMany(TransactionDetail::class, 'account_code');
    }

    public function parent_account()
    {
    	return $this->hasOne($this, 'account_code');
    }
}
