<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Loan;
use App\Member;
use App\LoanType;

class LoansController extends Controller
{
    public function index()
    {
    	$loans = Loan::all();
    	return view('loans.index', compact('loans'));
    }

    public function create()
    {
    	$columns = $this->getFormData();
    	$model = new Loan();
		return view('loans.create', compact('columns', 'model'));
    }

	public function store(Request $request)
    {
    	Loan::create($this->validateRequest($request));

        return redirect('loans')->with([
            'message' => "Loan successfully added.",
            'styles' => 'alert-success'
        ]);
    }
	
    private function getColumns()
    {
    	$column_names = Loan::columnNames();
        $column_types = array_map(function($name) {
            return DB::getSchemaBuilder()->getColumnType('loans', $name);
        }, $column_names);

        return array_combine($column_names, $column_types);
    }
	
	#transforms_column data for more user defined arguments
	private function getFormData()
	{
		$columns = $this->getColumns();
		foreach ($columns as $column_name => $column_type){
			$columns[$column_name] = [
				'type' => $column_type,
				'choices' => null,
			];
		}
		
		$columns['member_id']['choices'] = Member::names()->get()->pluck('full_name', 'id');
		$columns['loan_type']['choices'] = LoanType::names()->get()->pluck('name', 'name');
		$columns['loan_type']['select_box'] = true;
		return $columns;
	}
	
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
