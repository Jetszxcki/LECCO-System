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
}
