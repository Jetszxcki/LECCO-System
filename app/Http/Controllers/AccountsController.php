<?php

namespace App\Http\Controllers;

use App\Account;
use App\ColumnUtil;

class AccountsController extends Controller
{
    public function index()
    {
        $main = Account::where('parent_account', '')->first();
        
        $attrWithChoices = $this->attributesWithChoices();
    	$columns = ColumnUtil::getColNamesAndTypes('accounts', $attrWithChoices);
        $model = new Account();
        
        return view('chart_of_accounts.index', compact('main', 'columns', 'model'));
    }
    
    private function attributesWithChoices()
    {
        return [
          'parent_account' => Account::all()->pluck('account_code', 'account_code')
        ];
    }
}
