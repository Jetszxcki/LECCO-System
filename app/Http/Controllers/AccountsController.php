<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;
use App\ColumnUtil;

class AccountsController extends Controller
{
    public function index()
    {
        $main = Account::main();
        
        // $attrWithChoices = $this->attributesWithChoices();
    	$columns = ColumnUtil::getColNamesAndTypes('accounts');
        $columns['parent_account']['args'] = ['disabled'];
        $model = new Account();
        $unique_index = 0;
        
        return view('chart_of_accounts.index', compact('main', 'columns', 'model', 'unique_index'));
    }

    public function store(Request $request)
    {
        Account::create($this->validatedRequest($request));

        return redirect('chart_of_accounts')->with([
            'message' => 'Account successfully added.',
            'styles' => 'alert-success'
        ]);   
    }

    public function update(Request $request, Account $account)
    {
        $data = $this->validatedRequest($request);

        $parent_code = $request['parent_account'];
        $account_code = $request['account_code'];
        $account_name = $request['name'];

        $notif = [
            'message' => "Account {$account_code} ({$account_name}) has been successfully updated.",
            'styles' => 'alert-success'
        ];

        if ($account_code == $parent_code) {
            $notif['message'] = 'Unable to update. Account must not have the same parent account and account code.';
            $notif['styles'] = 'alert-danger';
        } else {
            // check if account_code has been changed
            if ($account_code != $account->account_code) {
                if($account->hasChildren()) {
                    foreach ($account->children as $child) {
                        $child->parent_account = $account_code;
                        $child->update($child->getAttributes());
                    }
                }
            }
            $account->update($data);
        }

        return redirect('chart_of_accounts')->with($notif);
    }

    public function destroy(Account $account)
    {
        $account->delete();

        return redirect('chart_of_accounts')->with([
            'message' => "{$account->account_code} has been deleted.",
            'styles' => 'alert-danger'
        ]);
    }
    
    // private function attributesWithChoices()
    // {
    //     return [
    //       'parent_account' => Account::all()->pluck('account_code', 'account_code')
    //     ];
    // }

    private function validatedRequest($request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'parent_account' => 'required',
            'account_code' => 'required|unique:accounts'
        ]);

        if ($validator->fails()) {
            dd('poat');
        }
    }
}
