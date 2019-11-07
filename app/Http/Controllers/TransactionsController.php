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
            'transaction_details' => 'required',
    	]);
        
        $main_data = $request->validate([
    		'transaction_code' => 'required',

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
}
