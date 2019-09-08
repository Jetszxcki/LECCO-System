<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
		$model = $user;
		$columns = $this->getColumns();
		return view('users.show_rights', compact('columns', 'model'));
	}

	public function update_rights(Request $request, User $user)
	{
		$row = [];
		foreach ($request->input() as $k => $v) {
			if($k != '_token') {
				$row[$k] = $v;
			}
		}

		$columns = array_combine(AccessRight::columnNames(), AccessRight::columnNames());
		$access_rights_values = array_intersect_key($row, $columns);

		foreach ($columns as $column) {
			if(strpos($column, 'id') !== false){
				continue;
			}
			if(!array_key_exists($column, $access_rights_values)){
				$access_rights_values[$column] = false;
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
	
 	private function getColumns()
    {
    	$column_names = AccessRight::columnNames();
        $column_types = array_map(function($name) {
            return DB::getSchemaBuilder()->getColumnType('access_rights', $name);
        }, $column_names);

        return array_combine($column_names, $column_types);
    }
}
