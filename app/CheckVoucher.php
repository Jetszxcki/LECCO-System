<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Transaction;

class CheckVoucher extends Model
{
    protected $guarded = [];
    
    public function transaction()
    {
    	return $this->belongsTo(Transaction::class, 'transaction_id');
    }
    
    public function getColumnNameForView($column)
    {
        return ucwords(str_replace('_', ' ', $column));
    }
}
