<?php   

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Member;

class MembersController extends Controller
{
    public function index()
    {
    	$members = Member::names()->get();
    	return view('members.index', compact('members'));
    }

    // REMIND: install dependency via composer require doctrine/dbal
    public function create()
    {
        $columns = $this->getFormData();
        $model = new Member();
    	return view('members.create', compact('columns', 'model'));
    }

    public function store(Request $request)
    {
        Member::create($this->validateRequest($request));
        return redirect('members');
    }

    public function show(Member $member)
    {	
    	return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {	 
        $model = $member;
		$columns = $this->getColumns();
    	return view('members.edit', compact('model', 'columns'));
    }

    public function update(Member $member, Request $request)
    {
    	$member->update($this->validateRequest($request));
    	return redirect('members/' . $member->id);
    }

    public function destroy(Member $member)
    {	
    	$member->delete();
    	return redirect('members');
    }

    // other functions
    private function getColumns()
    {
    	$column_names = Member::columnNames();
        $column_types = array_map(function($name) {
            return DB::getSchemaBuilder()->getColumnType('members', $name);
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
		
		$columns['gender']['choices'] = ['Male', 'Female', 'X-Men'];
		return $columns;
	}

    private function validateRequest($request)
    {
        return $request->validate([
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'birthday' => 'required',
            'age' => 'required|gte:0',
            'gender' => 'required',
            'civil_status' => 'required',
            'religion' =>'required',
            'highest_educational_attainment' => 'required',
            'no_of_dependents' => 'required|gte:0',
            'residential_address' => 'required',
            'TIN' => 'required',
            'employer' => 'required',
            'department' => 'required',
            'position' => 'required',
            'annual_income' => 'required',
            'length_of_service(years)' => 'required|gte:0',
            'status_of_employment' => 'required',
            'no_of_subscribed_shares' => 'required',
            'years_to_fully_pay' => 'required|gte:0',
            'contact_no' => 'required',
            'date_accepted' => 'required',
            'BOD_resolution_number' => 'required',
            'type_of_membership' => 'required'
        ]);
    }
}
