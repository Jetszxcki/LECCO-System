<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Transaction;

class CheckVoucher extends Model
{
    public function transaction()
    {
    	return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
