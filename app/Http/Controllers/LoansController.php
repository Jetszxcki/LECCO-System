<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Loan;
use App\Member;
use App\LoanType;
use App\Payroll;
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
    	$attrWithChoices = $this->attributesWithChoices();
    	$columns = ColumnUtil::getColNamesAndTypes('loans', $attrWithChoices);
		$columns['payrolls']['multiple'] = True;
    	$model = new Loan();

        $interests = LoanType::interests()->get();
        
    	return view('loans.create', compact('columns', 'model', 'interests'));
    }

	public function store(Request $request)
    {
		[$validated_loan_data, $validated_payrolls_data, $validated_payment_schedule] = $this->validateRequest($request);
		$validated_payment_schedule = json_decode($validated_payment_schedule['payment_schedule'], true);// 2nd args is to assoc, parse as hash instead of object
		
		Loan::createWithRelationships($validated_loan_data, $validated_payrolls_data, $validated_payment_schedule);
		
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
	
	public function show(Loan $loan)
    {	
    	return view('loans.show', compact('loan'));
    }

    public function edit(Loan $loan)
    {
        $model = $loan;
        $attrWithChoices = $this->attributesWithChoices();
    	$columns = ColumnUtil::getColNamesAndTypes('loans', $attrWithChoices);
		$columns['payrolls']['multiple'] = True;
        session()->now('message', 'NOTE: Changing loan will reset payment schedule.');
        session()->now('styles', 'alert-danger');
        return view('loans.edit', compact('model', 'columns'));
    }
    
    public function update(Request $request, Loan $loan)
    {
        [$validated_loan_data, $validated_payrolls_data, $validated_payment_schedule] = $this->validateRequest($request);
        $validated_payment_schedule = json_decode($validated_payment_schedule['payment_schedule'], true);// 2nd args is to assoc, parse as hash instead of object
        
        Loan::updateWithRelationships($loan, $validated_loan_data, $validated_payrolls_data, $validated_payment_schedule);
        return redirect('loans/' . $loan->id)->with([
            'message' => "Loan successfully updated.",
            'styles' => 'alert-success'
        ]);
    }
    
    private function attributesWithChoices()
    {
        return [
          'member_id' => Member::names()->get()->pluck('full_name', 'id'),
          'loan_type' => LoanType::names()->get()->pluck('name', 'id'),
		  'payrolls' => Payroll::names()->get()->pluck('name', 'id')
        ];
    }
		
	private function validateRequest($request)
    {
		$data_to_validate = [
            'member_id' => 'required',
            'loan_type' => 'required',
            'amount' => 'required|gte:0',
            'term' => 'required|gte:0',
            'start_of_payment' => 'required',
            'interest_per_annum' => 'required|gte:0',
			'payrolls' => 'required',
			'payment_schedule' => 'required',
        ];
		//base validation
		$base_validated_data = $request->validate($data_to_validate);
		
		//Note: must be after $base_validated_data to validate loan_type exist (less code)
		$loan_type = LoanType::find($base_validated_data['loan_type']);
		if($loan_type->amount_minimum < $loan_type->amount_maximum){
			$amount_minimum = intval($loan_type->amount_minimum);
			$amount_maximum = intval($loan_type->amount_maximum);
			$data_to_validate['amount'] = 'required|gte:'.strval($amount_minimum).'|lte:'.strval($amount_maximum);
		}
		if($loan_type->payment_period_minimum < $loan_type->payment_period_maximum){
			$term_minimum = intval($loan_type->payment_period_minimum);
			$term_maximum = intval($loan_type->payment_period_maximum);
			$data_to_validate['term'] = 'required|gte:'.strval($term_minimum).'|lte:'.strval($term_maximum);
		}
		
		//need to include other data so other data is maintained in form
		//this is main validation
		$request->validate($data_to_validate);
		
		
		//extracting data to respective places (cause i copy pase is easier lol)
		$validated_loan_data = $request->validate([
			'member_id' => 'required',
            'loan_type' => 'required',
            'amount' => 'required|gte:0',
            'term' => 'required|gte:0',
            'remarks' => 'nullable',
            'start_of_payment' => 'required',
            'interest_per_annum' => 'required|gte:0',
		]);
		
		
		$validated_payroll_data = $request->validate([
            'payrolls' => 'required',
        ]);
		
		$validated_payment_schedule = $request->validate([
            'payment_schedule' => 'required',
        ]);
        return [$validated_loan_data, $validated_payroll_data, $validated_payment_schedule];
    }
}
