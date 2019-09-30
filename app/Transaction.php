<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\TransactionDetail;
use App\CheckVoucher;
use App\User;

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

    public function user_created()
    {
    	return $this->hasOne(User::class, 'created_by');
    }

    public function user_updated()
    {
    	return $this->hasOne(User::class, 'updated_by');
    }
}
