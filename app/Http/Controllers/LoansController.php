<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Loan;
use App\Member;
use App\LoanType;
use App\ColumnUtil;

class LoansController extends Controller
{
    public function index()
    {
    	$loans = Loan::all();
    	return view('loans.index', compact('loans'));
    }

    public function create()
    {
        // $columns = $this->getFormData();

        // array of column names with choices (see function below)
        $fieldsWithChoices = $this->attributesWithChoices()[0]; 

        // array of choices for the corresponding column names above
        // NOTE: ALWAYS NAME THIS VARIABLE $choices
        $choices = $this->attributesWithChoices()[1];

        /* 
            - getColNamesAndTypes function has 3 params:
            1. required: main table/model to be displayed
            2. optional: array of column names that needs to be disabled
            3. optional: array of column names that has choices in form
        */
    	$columns = ColumnUtil::getColNamesAndTypes('loans', [], $fieldsWithChoices); 

    	$model = new Loan();
		return view('loans.create', compact('columns', 'model', 'choices')); //  apss choices here
    }

	public function store(Request $request)
    {
    	Loan::create($this->validateRequest($request));

        return redirect('loans')->with([
            'message' => "Loan successfully added.",
            'styles' => 'alert-success'
        ]);
    }
	
	public function destroy(Loan $loan)
    {
        $loan->delete();
        return redirect('loans')->with([
            'message' => "Loan has been deleted.",
            'styles' => 'alert-danger'
        ]);
    }

    private function attributesWithChoices()
    {
        return [
            // column names that has choices
            [
                'member_id',
                'loan_type'
            ],
            // there corresponding choices
            /* 
                NOTE: always make 1 as the first element for this array, because
                it is used as the iterator on form.blade.php
            */
            [
                1,
                Member::names()->get()->pluck('full_name', 'id'),    
                LoanType::names()->get()->pluck('name', 'id')
            ]
        ];
    }
	
	#transforms_column data for more user defined arguments
	// private function getFormData()
	// {
	// 	$columns = ColumnUtil::getColNamesAndTypes('loans');
	// 	foreach ($columns as $column_name => $column_type){
	// 		$columns[$column_name] = [
	// 			'type' => $column_type,
	// 			'choices' => null,
	// 		];
	// 	}
		
	// 	$columns['member_id']['choices'] = Member::names()->get()->pluck('full_name', 'id');
	// 	$columns['loan_type']['choices'] = LoanType::names()->get()->pluck('name', 'name');
	// 	$columns['loan_type']['select_box'] = true;
	// 	return $columns;
	// }
	
	private function validateRequest($request)
    {
        return $request->validate([
            'member_id' => 'required',
            'loan_type' => 'required',
            'amount' => 'required|gte:0',
            'term' => 'required|gte:0',
            'start_of_payment' => 'required',
            'interest_per_annum' => 'required|gte:0',
        ]);
    }
}
