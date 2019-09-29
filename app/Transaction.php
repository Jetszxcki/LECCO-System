<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\TransactionDetail;
use App\CheckVoucher;

class Transaction extends Model
{
    public function transaction_details()
    {
    	return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }

    public function check_voucher()
    {
    	return $this->hasOne(CheckVoucher::class, 'transaction_id');
    }
}
