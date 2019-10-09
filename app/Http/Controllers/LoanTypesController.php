<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\LoanType;
use App\ColumnUtil;

class LoanTypesController extends Controller
{
    public function index()
    {   
        $loan_types = LoanType::names()->get();
        return view('loan_types.index', compact('loan_types'));
    }

    public function create()
    {
        $columns = ColumnUtil::getColNamesAndTypes('loan_types');
        $model = new LoanType();
        return view('loan_types.create', compact('columns', 'model'));
    }

    public function store(Request $request)
    {
        LoanType::create($this->validateRequest($request));

        return redirect('loan_types')->with([
            'message' => "{$request->name} successfully added.",
            'styles' => 'alert-success'
        ]);
    }

    public function show(LoanType $loan_type)
    {
        return view('loan_types.show', compact('loan_type'));
    }

    public function edit(LoanType $loan_type)
    {
        $model = $loan_type;
        $columns = ColumnUtil::getColNamesAndTypes('loan_types');
        return view('loan_types.edit', compact('model', 'columns'));
    }

    public function update(Request $request, LoanType $loan_type)
    {
        $loan_type->update($this->validateRequest($request, $loan_type));
        return redirect('loan_types')->with([
            'message' => "{$loan_type->name} successfully updated.",
            'styles' => 'alert-success'
        ]);
    }

    public function destroy(LoanType $loan_type)
    {
        $loan_type->delete();
        return redirect('loan_types')->with([
            'message' => "{$loan_type->name} has been deleted.",
            'styles' => 'alert-danger'
        ]);
    }
	
    private function validateRequest($request, $loan_type = null)
    {
        return $request->validate([
            'name' => 'required|unique:loan_types,name,' . ($loan_type != null ? $loan_type->id : ''),
            'interest_per_annum' => 'required',
            'amount_minimum' => 'required|lte:amount_maximum',
            'amount_maximum' => 'required|gte:amount_minimum',
            'payment_period_minimum' => 'required|lte:payment_period_maximum',
            'payment_period_maximum' => 'required|gte:payment_period_minimum'
        ]);
    }
}
