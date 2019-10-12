<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

use App\TransactionDetail;
use App\Transaction;

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
    
    // change func name
    public function getDetailsReportAttribute()
    {
        $journal = 'CV';
        $totals = [
            'main' => ['debit' => 0, 'credit' => 0],
            'children' => ['debit' => 0, 'credit' => 0]
        ];
        $transactions =  Transaction::all()->where('transaction_code', $journal)->pluck('id');
        $transaction_details = $this->transaction_details()->whereIn('transaction_id', $transactions)->get(['debit', 'credit']);
        $totals['main']['debit'] = $transaction_details->sum('debit');
        $totals['main']['credit'] = $transaction_details->sum('credit');
        
        if($this->hasChildren())
        {
            foreach($this->children()->get() as $child){
                $child_totals = $child->details_report;
                $totals['children']['debit'] = $totals['children']['debit'] + $child_totals['total']['debit'];
                $totals['children']['credit'] = $totals['children']['credit'] + $child_totals['total']['credit'];
            }
        }
        
        $totals['total'] = [
            'debit' => $totals['main']['debit'] + $totals['children']['debit'],
            'credit' => $totals['main']['credit'] + $totals['children']['credit']
        ];
        
        return collect($totals);
    }
}
