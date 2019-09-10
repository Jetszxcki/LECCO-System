<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\LoanType;

class LoanTypesController extends Controller
{
    public function index()
    {   
        $loan_types = LoanType::names()->get();
        return view('loan_types.index', compact('loan_types'));
    }

    public function create()
    {
        $columns = $this->getFormData();
        $model = new LoanType();
        return view('loan_types.create', compact('columns', 'model'));
    }

    public function store(Request $request)
    {
        LoanType::create($this->validateRequest($request));
        return redirect('loan_types');
    }

    public function show(LoanType $loan_type)
    {
        return view('loan_types.show', compact('loan_type'));
    }

    public function edit(LoanType $loan_type)
    {
        $model = $loan_type;
        $columns = $this->getColumns();
        return view('loan_types.edit', compact('model', 'columns'));
    }

    public function update(Request $request, LoanType $loan_type)
    {
        $loan_type->update($this->validateRequest($request));
        return redirect('loan_types/' . $loan_type->name);
    }

    public function destroy(LoanType $loan_type)
    {
        $loan_type->delete();
        return redirect('loan_types');
    }

    private function getColumns()
    {
        $column_names = LoanType::columnNames();
        $column_types = array_map(function($name) {
            return DB::getSchemaBuilder()->getColumnType('loan_types', $name);
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
				'initial_value' => null,
				'error_message' => null,
			];
		}
		
		return $columns;
	}
	
    private function validateRequest($request)
    {
        return $request->validate([
            'name' => 'required',
            'interest_per_annum' => 'required',
            'amount_minimum' => 'required',
            'amount_maximum' => 'required',
            'payment_period_minimum' => 'required',
            'payment_period_maximum' => 'required'
        ]);
    }
}
