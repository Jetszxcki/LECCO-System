<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Transaction;
use App\Account;

class TransactionDetail extends Model
{
    protected $guarded = [];
    
    public function transaction()
    {
    	return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function account()
    {
    	return $this->belongsTo(Account::class, 'account_id');
    }
}
