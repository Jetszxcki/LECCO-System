<?php

namespace App\Http\Controllers;

use App\Account;
use App\ColumnUtil;

class AccountsController extends Controller
{
    public function index()
    {
        $mains = Account::noParent();
        
        $attrWithChoices = $this->attributesWithChoices();
    	$columns = ColumnUtil::getColNamesAndTypes('accounts', $attrWithChoices);
        $model = new Account();
        $unique_index = 0;
        
        return view('chart_of_accounts.index', compact('mains', 'columns', 'model', 'unique_index'));
    }
    
    private function attributesWithChoices()
    {
        return [
          'parent_account' => Account::all()->pluck('account_code', 'account_code')
        ];
    }
}
