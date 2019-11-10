<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;
use App\Transaction;
use App\CheckVoucher;
use App\ColumnUtil;
use Carbon\Carbon;

class CheckVouchersController extends Controller
{
    public function index()
    {   
        $cv = CheckVoucher::all();
        return view('check_vouchers.index', compact('cv'));
    }

    public function create()
    {
        $attrWithChoices = $this->attributesWithChoices();
        $columns = ColumnUtil::getColNamesAndTypes('check_vouchers', $attrWithChoices);
        $model = new CheckVoucher();
		$model->cv_no = CheckVoucher::getNextCvNo();
        
    	$columns2 = ColumnUtil::getColNamesAndTypes('transactions');
    	$columns2['transaction_code_id']['type'] = 'none';
    	$columns2['transaction_code']['type'] = 'none';
        $model2 = new Transaction();
        
        $accounts = Account::all();
        
        return view('check_vouchers.create', compact('columns', 'columns2', 'model', 'model2', 'accounts'));
    }
    
    public function store(Request $request)
    {
        [$cv_data, $transaction_data, $details_data] = $this->validateRequest($request);
        if($request->has('new_transaction_flag')){
            $details_data = json_decode($details_data['transaction_details'], true);
            $transaction_data['transaction_code'] = 'CV';
            $cv_data['transaction_id'] = Transaction::createWithDetails($transaction_data, $details_data)->id;
        }
        
        $cv = CheckVoucher::create($cv_data);
        
        if($request->hasFile('attachment') && $request->file('attachment')->isValid()){
            $file = $request->file('attachment');
            $name = sha1(\Carbon\Carbon::now('Asia/Manila')->toDateTimeString());
            $file->move(public_path().'/cv/', $name);
            $cv->update(['attachment' => $name]);
        }
    }
    
    private function attributesWithChoices()
    {
        $transaction_ids = Transaction::all()->whereIn('transaction_code', 'CV')->pluck('id')->all();
        $cv_ids = CheckVoucher::all()->pluck('transaction_id')->all();
        $cv_ids = array_diff($transaction_ids, $cv_ids);
        $cv_ids = array_combine($cv_ids, $cv_ids);
        return [
            'transaction_id' => $cv_ids,
        ];
    }
    
    private function validateRequest($request)
    {
    	$base_validation = $request->validate([
            'transaction_details' => 'required',
            'cv_no' => 'required',
            'check_no' => 'required'
    	]);
        
        $cv_data = $request->validate([
            'cv_no' => 'required',
            'check_no' => 'required',
            'transaction_id' => 'required'
        ]);
        
        $transaction_data = [];
        $details_data = [];
        if($request->has('new_transaction_flag')){
            $transaction_data = $request->validate([
                'payee' => 'required',
                'transaction_date' => 'required',
                'date_disbursed' => 'nullable',
                'disbursed_by' => 'required',
                'description' => 'required',
            ]);
            
            $details_data = $request->validate([
                'transaction_details' => 'required'
            ]);
        }
        
        return [$cv_data, $transaction_data, $details_data];
    }
}
