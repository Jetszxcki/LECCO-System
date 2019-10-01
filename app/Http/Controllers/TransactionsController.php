<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    	return view('transactions.create', compact('columns', 'model'));
    }

    public function store(Request $request)
    {
    	// get all transactions with the same journal
    	$transactions = Transaction::journal($request->transaction_code);
        // dd($this->findFirstMissingID($arr, 0, count($arr)-1));

    	if ($transactions->isEmpty()) {
    		$request['transaction_code_id'] = 0;
    	} else {
            $journal_id_arr = $transactions->toArray();
            $journal_id_arr = array_column($journal_id_arr, 'transaction_code_id');
            sort($journal_id_arr);
            $last_id_index = count($journal_id_arr) - 1;
            
            $missing_transaction_id = $this->findFirstMissingID($journal_id_arr, 0, $last_id_index);
            $max_transaction_id = $transactions->max('transaction_code_id');
            // dd($missing_transaction_id);

            // if there is a missing journal id   -->   e.g.(0,1,3,4,5...) 
            if (($missing_transaction_id - 1) != $journal_id_arr[$last_id_index]) {
                $request['transaction_code_id'] = $missing_transaction_id;
            } else {
                $request['transaction_code_id'] = $max_transaction_id + 1;
            }
    	}
    	
    	Transaction::create($this->validateRequest($request));

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

    private function attributesWithChoices()
    {
    	$journals = ['CV', 'APV', 'JV'];
    	return [
    		'transaction_code' => array_combine($journals, $journals)
    	];
    }

    private function validateRequest($request)
    {
    	return $request->validate([
    		'transaction_code' => 'required',
    		'transaction_code_id' => 'required'
    	]);
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