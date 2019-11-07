<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Auth;
use App\TransactionDetail;
use App\CheckVoucher;
use App\User;

class Transaction extends Model
{
    protected $guarded = [];

    public function scopeJournal($query, $transaction_code)
    {
        return $query->select('transaction_code_id')->where('transaction_code', $transaction_code)->get();
    }
    
    //this is to render a string form for forms when editing.
    public function getTransactionDetailsAsJsonAttribute()
    {
        return json_encode($this->transaction_details()->select(['account_code', 'debit', 'credit'])->get()); // use this to get details for form;
    }
    
    public function getTotalDebitAttribute()
    {
        return $this->transaction_details()->get()->sum(['debit']); // use this to get details for form;
    }
    
    public function getTotalCreditAttribute()
    {
        return $this->transaction_details()->get()->sum(['credit']); // use this to get details for form;
    }

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
    	return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function user_updated()
    {
    	return $this->hasOne(User::class, 'id', 'updated_by');
    }

    public function getColumnNameForView($column)
    {
        return ucwords(str_replace('_', ' ', $column));
    }
    
    public static function createWithDetails($transaction_data, $details_data){
    	$transactions = Transaction::journal($transaction_data['transaction_code']);
    	if ($transactions->isEmpty()) {
    		$transaction_data['transaction_code_id'] = 1;
    	} else {
            $ids = $transactions->pluck('transaction_code_id')->all();
            $full_seq = range(1,max($ids));
            $missing_nums = array_diff($full_seq,$ids);
            $transaction_data['transaction_code_id'] = count($missing_nums) ? array_values($missing_nums)[0] : intval(max($ids))+1 ;
    	}
        
        DB::beginTransaction();
        $transaction =  Transaction::create($transaction_data);
        
        foreach($details_data as $detail_data){
            $detail_data['transaction_id'] = $transaction->id;
            $transaction->transaction_details()->create($detail_data);
        }
        DB::commit();
        return $transaction;
    }
    
    // this is a recommended way to declare event handlers
	public static function boot() {
		parent::boot();

		// create a event to happen on saving
        static::saving(function($table)  {
            $table->created_by = Auth::user()->id;
        });
        
        // create a event to happen on updating
        static::updating(function($table)  {
            $table->updated_by = Auth::user()->id;
        });
        
        static::deleting(function($transaction) { // before delete() method call this
            DB::beginTransaction();
			// cleanup relationships (LOL)
            $transaction = $transaction->transaction_details()->delete();
			DB::commit();
		});
	}
}
