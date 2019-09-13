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

        /* 
            - declare array of column names with choices

            NOTE: First element of array will become the first input field on form view.
        */
        $fieldsWithChoices = ['member_id', 'loan_type']; 

        /* 
            - getColNamesAndTypes function has 3 params:
            1. required: main table/model to be displayed
            2. optional: array of column names that needs to be disabled
            3. optional: array of column names that has choices in form
        */
    	$columns = ColumnUtil::getColNamesAndTypes('loans', [], $fieldsWithChoices); 

        /*
            - create function attributesWithChoices(found below), which holds an array of 
            the choices that needs to be passed on the form @here
        */
        $withChoices = $this->attributesWithChoices();

    	$model = new Loan();
		return view('loans.create', compact('columns', 'model', 'withChoices')); //  @here
    }

	public function store(Request $request)
    {
    	Loan::create($this->validateRequest($request));

        return redirect('loans')->with([
            'message' => "Loan successfully added.",
            'styles' => 'alert-success'
        ]);
    }

    private function attributesWithChoices()
    {
        /*
            - declare every query of choices that needs to be passed on to the form
            NOTE: always make 1 as the first element, as it is needed for iteration on form.blade.php
            NOTE: also, the sequence of declaration must be equal to the $fieldWithChoices declared above
        */
        return [
            1,
            Member::names()->get()->pluck('full_name', 'id'),    
            LoanType::names()->get()->pluck('name')
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
