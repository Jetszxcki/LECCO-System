<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Transaction;
use App\ColumnUtil;

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
	
	public static function getNextCvNo(){
		$current_year = intval(date("Y"));
		$cv_digits = 10000;
		$cv_no_field_name = 'cv_no';
		$cv_nos = CheckVoucher::whereBetween($cv_no_field_name, [$current_year*$cv_digits, ($current_year+1)*$cv_digits])->pluck($cv_no_field_name)->all();
		
		if(count($cv_nos) == 0){
			return ($current_year*$cv_digits)+1;
		}
		
		$missing = ColumnUtil::getMissingInSequence($cv_nos);
		return count($missing) ? $missing[0] : (max($cv_nos)+1);
	}
}
