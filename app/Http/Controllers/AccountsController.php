<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

use App\Account;
use App\Transaction;
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
        $data = $this->validatedRequest($request, $account);

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
    
    public function summaryOfAccounts(Request $request)
    {
        $main = Account::main();
        $query_params['journal'] = array_key_exists('journal', $_GET)? $_GET['journal']: ['CV'];
        $query_params['start_date'] = array_key_exists('start_date', $_GET)? $_GET['start_date']: Transaction::all()->min('transaction_date');
        $query_params['end_date'] = array_key_exists('end_date', $_GET)? $_GET['end_date']: Transaction::all()->max('transaction_date');
        $query_params = collect($query_params);
        return view('journal.journal_report', compact('main', 'query_params'));
    }
    
    // private function attributesWithChoices()
    // {
    //     return [
    //       'parent_account' => Account::all()->pluck('account_code', 'account_code')
    //     ];
    // }

    private function validatedRequest($request, $account = null)
    {
        return $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'parent_account' => 'required',
            'account_code' => 'required|unique:accounts,account_code,' . ($account != null ? $account->id : '')
        ]);
    }
}
