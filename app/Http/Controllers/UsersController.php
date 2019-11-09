<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\AccessRight;

class UsersController extends Controller
{
    public function index()
    {
		$users = User::select('id', 'avatar', 'name', 'email')->get();
		return view('users.index', compact('users'));
	}

	public function show_rights(User $user)
	{		
		$columns = AccessRight::columnNames();
		return view('users.show_rights', compact('columns', 'user'));
	}

	public function update_rights(Request $request, User $user)
	{
		$row = [];

		foreach ($request->input() as $k => $v) {
			if($k != '_token') {
				$row[$k] = $v;
			}
		}

		$columns = AccessRight::columnNames();
		$access_rights_values = [];

		foreach ($columns as $cname) {
			if ($cname != 'user_id') {
				$access_rights_values[$cname] = isset($row[$cname]);
			}
		}

		AccessRight::where('user_id', $user->id)->update($access_rights_values);

		return redirect('users')->with([
			'message' => "{$user->name}'s privileges successfully updated.",
			'styles' => 'alert-success'
		]);
	}

	public function destroy(User $user)
	{
		$user->delete();
		return redirect('users')->with([
			'message' => "{$user->name} has been deleted.",
			'styles' => 'alert-danger',
		]);
	}

	public function profile(User $user)
    {
        return view('users.profile', compact('user'));
    }

    public function update_avatar(Request $request, User $user)
    {    	
        $old_password = $request['old_password']; # old password field
        $new_password = $request['password']; # new password field
        $confirm_password = $request['password_confirmation']; # confirm password field

        $are_pass_fields_nullable = ($old_password == '' && $new_password == '' && $confirm_password == '');
        $requirement = $are_pass_fields_nullable ? 'nullable' : 'required';
        $avatar_requirement = $request->avatar == null ? 'nullable' : 'required';

        $request->validate([
            'avatar' => "{$avatar_requirement}|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            'old_password' => "{$requirement}",
            'password' => "{$requirement}|min:7|confirmed",
        ]);


        if (! $are_pass_fields_nullable) {
            if (password_verify($old_password, $user->password)) {
                $user->password = password_hash($request['password'], PASSWORD_DEFAULT);
            } else {
                return redirect()->route('users.profile', [$user])->with([
                    'message' => 'Password incorrect. Try again.',
                    'styles' => 'alert-danger px-4'
                ]);
            }
        }

        if ($request->avatar != null) {
            $avatarName = $user->id . 'user.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('images'), $avatarName);
            $user->avatar = $avatarName;
        }
        $user->save();
 
        return redirect()->route('users.profile', [$user])->with([
            'message' => 'Profile info successfully updated.',
            'styles' => 'alert-success px-4'
        ]);          
    }
}
