<?php   

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Member;
use App\ColumnUtil;

class MembersController extends Controller
{
    public function index()
    {
    	$members = Member::names()->get();
    	return view('members.index', compact('members'));
    }

    public function create()
    {
        $attrWithChoices = $this->attributesWithChoices();
        $columns = ColumnUtil::getColNamesAndTypes('members', $attrWithChoices);
        $model = new Member();

    	return view('members.create', compact('columns', 'model'));
    }

    public function store(Request $request)
    {
        Member::create($this->validateRequest($request));

        return redirect('members')->with([
            'message' => "{$request->first_name} {$request->last_name} successfully added.",
            'styles' => 'alert-success'
        ]);
    }

    public function show(Member $member)
    {	
    	return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {	 
        $attrWithChoices = $this->attributesWithChoices();
        $columns = ColumnUtil::getColNamesAndTypes('members', $attrWithChoices);
        $model = $member;

        return view('members.edit', compact('columns', 'model'));
    }

    public function update(Member $member, Request $request)
    {
        $data = $this->validateRequest($request);

        if ($request->profile_picture) 
        {
            $request->validate([
                'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            
            $prof_pic = $member->id . 'member.' . $request->profile_picture->getClientOriginalExtension();
            $request->profile_picture->move(public_path('images'), $prof_pic);
            $data['profile_picture'] = $prof_pic;
        }

        $member->update($data);

    	return redirect('members/' . $member->id)->with([
            'message' => "{$member->full_name}'s profile successfully updated.",
            'styles' => 'alert-success'
        ]);;
    }

    public function destroy(Member $member)
    {	
    	$member->delete();
    	return redirect('members')->with([
            'message' => "{$member->full_name} has been deleted.",
            'styles' => 'alert-danger'
        ]);;
    }

    private function attributesWithChoices()
    {
		$genders = ['Male', 'Female', 'X-Men'];
        return [
            'gender' => array_combine($genders, $genders)
        ];
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
