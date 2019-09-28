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
        
    	return view('loans.create', compact('columns', 'model'));
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
		$validated_loan_data = $request->validate([
            'member_id' => 'required',
            'loan_type' => 'required',
            'amount' => 'required|gte:0',
            'term' => 'required|gte:0',
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
