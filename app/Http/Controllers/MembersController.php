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
        $column_names = Member::columnNames();
        $column_types = array_map(function($value) {
            return DB::getSchemaBuilder()->getColumnType('members', $value);
        }, $column_names);

        $columns = array_combine($column_names, $column_types);
        $member = new Member();

    	return view('members.create', compact('columns', 'member'));
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

    private function validateRequest($request)
    {
        return $request->validate([
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'birthday' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'civil_status' => 'required',
            'religion' =>'required',
            'highest_educational_attainment' => 'required',
            'no_of_dependents' => 'required',
            'residential_address' => 'required',
            'TIN' => 'required',
            'employer' => 'required',
            'department' => 'required',
            'position' => 'required',
            'annual_income' => 'required',
            'length_of_service(years)' => 'required',
            'status_of_employment' => 'required',
            'no_of_subscribed_shares' => 'required',
            'years_to_fully_pay' => 'required',
            'profile_picture' => 'nullable',
            'contact_no' => 'required',
            'date_accepted' => 'required',
            'BOD_resolution_number' => 'required',
            'type_of_membership' => 'required'
        ]);
    }
}
