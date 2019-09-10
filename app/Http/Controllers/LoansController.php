<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Loan;
use App\Member;

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
    	$members = Member::names()->get();
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
				'initial_value' => null,
				'error_message' => null,
			];
		}
		
		return $columns;
	}
}
