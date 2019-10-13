<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;
use App\Transaction;
use App\ColumnUtil;

class TransactionsController extends Controller
{
    public function index()
    {
    	$transactions = Transaction::all();
    	return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
    	$attrWithChoices = $this->attributesWithChoices();
    	$columns = ColumnUtil::getColNamesAndTypes('transactions', $attrWithChoices);
    	$columns['transaction_code_id']['type'] = 'none';
    	$model = new Transaction();
        
        $accounts = Account::all();
        
    	return view('transactions.create', compact('columns', 'model', 'accounts'));
    }

    public function store(Request $request)
    {
    	// get all transactions with the same journal
    	$transactions = Transaction::journal($request->transaction_code);

    	if ($transactions->isEmpty()) {
    		$request['transaction_code_id'] = 1;
    	} else {
            $journal_id_arr = $transactions->toArray();
            $journal_id_arr = array_column($journal_id_arr, 'transaction_code_id');
            array_push($journal_id_arr, "0");
            sort($journal_id_arr);
            $last_id_index = count($journal_id_arr) - 1;

            $missing_transaction_id = $this->findFirstMissingID($journal_id_arr, 0, $last_id_index);
            $max_transaction_id = $transactions->max('transaction_code_id');

            // if there is a missing journal id   -->   e.g.(0,1,3,4,5...) 
            if (($missing_transaction_id - 1) != $journal_id_arr[$last_id_index]) {
                $request['transaction_code_id'] = $missing_transaction_id;
            } else {
                $request['transaction_code_id'] = $max_transaction_id + 1;
            }
    	}
    	
        
        [$main_data, $details_data] = $this->validateRequest($request);
        $details_data = json_decode($details_data['transaction_details'], true);// 2nd args is to assoc, parse as hash instead of object
    	Transaction::createWithDetails($main_data, $details_data);

    	return redirect('transactions')->with([
            'message' => "Transaction successfully added.",
            'styles' => 'alert-success'
        ]);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect('transactions')->with([
            'message' => "Transaction has been deleted.",
            'styles' => 'alert-danger'
        ]);
    }
    
    public function show(Transaction $transaction)
    {	
    	return view('transactions.show', compact('transaction'));
    }
    
    public function edit(Transaction $transaction)
    {
        $model = $transaction;
        $attrWithChoices = $this->attributesWithChoices();
    	$columns = ColumnUtil::getColNamesAndTypes('transactions', $attrWithChoices);
    	$columns['transaction_code_id']['type'] = 'none';
        
        $accounts = Account::all();
        
        session()->now('message', 'NOTE: Changing loan will reset payment schedule.');
        session()->now('styles', 'alert-danger');
        return view('loans.edit', compact('model', 'columns'));
    }
    
    private function attributesWithChoices()
    {
    	$journals = ['CV', 'APV', 'JV'];
    	return [
    		'transaction_code' => array_combine($journals, $journals)
    	];
    }

    private function validateRequest($request)
    {
    	$base_validation = $request->validate([
    		'transaction_code' => 'required',
    		'transaction_code_id' => 'required',
            'transaction_details' => 'required',
    	]);
        
        $main_data = $request->validate([
    		'transaction_code' => 'required',
    		'transaction_code_id' => 'required',

            'payee' => 'required',
            'transaction_date' => 'required',
            'date_disbursed' => 'nullable',
            'disbursed_by' => 'required',
            'description' => 'required',
    	]);
        
        $details_data = $request->validate([
            'transaction_details' => 'required'
    	]);
        
        return [$main_data, $details_data];
    }

    public function findFirstMissingID($array, $start, $end) 
    {
        if ($start > $end)
            return $start;

        $mid = intval(($start + $end) / 2);

        if ($mid == $array[$mid])
            return $this->findFirstMissingID($array, $mid + 1, $end);

        return $this->findFirstMissingID($array, $start, $mid - 1);
    } 
}
