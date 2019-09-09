<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

		return redirect('users');
	}

	public function destroy(User $user)
	{
		$user->delete();
		return redirect('users');
	}

	public function profile()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    public function update_avatar(Request $request, User $user)
    { 
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 
        $user = Auth::user();
		$avatarName = $user->id.'user.'.$request->avatar->getClientOriginalExtension();
        $request->avatar->storeAs('avatars', $avatarName);
 
        $user->avatar = $avatarName;
        $user->save();
 
        return back()
            ->with('success','You have successfully upload image.');
 
    }
}
