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
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

		$avatarName = $user->id . 'user.' . $request->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('images'), $avatarName);
        $user->avatar = $avatarName;
        $user->save();
 
        return redirect()->route('users.profile', [$user])->with([
        	'message' => 'Profile picture successfully changed.',
        	'styles' => 'alert-success px-4'
        ]);
    }
}
