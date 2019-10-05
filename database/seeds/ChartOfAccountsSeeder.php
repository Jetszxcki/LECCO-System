<?php

use Illuminate\Database\Seeder;

use App\Account;

class ChartOfAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account1_1 = Account::create([
			'name' => 'Main',
			'description' => 'this is account should be at level 1',
			'parent_account' => '',
			'account_code' => 'AAA-BBB',
		]);

		$account1_2 = Account::create([
			'name' => 'Another Main',
			'description' => 'this is account should be at level 1',
			'parent_account' => '',
			'account_code' => 'AAA-AAA',
		]);

		$account2_4 = Account::create([
			'name' => 'Sub-1',
			'description' => 'this is account should be at level 2',
			'parent_account' => $account1_2->account_code,
			'account_code' => 'AAA-AAA-CCC',
		]);
        
        $account2_1 = Account::create([
			'name' => 'Sub-me',
			'description' => 'this is account should be at level 2',
			'parent_account' => $account1_1->account_code,
			'account_code' => 'AAA-BB1-CCC',
		]);
        
        $account2_2 = Account::create([
			'name' => 'Sub-2',
			'description' => 'this is account should be at level 2',
			'parent_account' => $account1_1->account_code,
			'account_code' => 'AAA-BB2-DDD',
		]);
        
        $account2_3 = Account::create([
			'name' => 'Sub-3',
			'description' => 'this is account should be at level 2',
			'parent_account' => $account1_1->account_code,
			'account_code' => 'AAA-BB3-EEE',
		]);
        
        $account3_2_1 = Account::create([
			'name' => 'Subsub-2-1',
			'description' => 'this is account should be at level 3',
			'parent_account' => $account2_2->account_code,
			'account_code' => 'AAA-BB2-CC1',
		]);
        
        $account3_2_2 = Account::create([
			'name' => 'Subsub-2-2',
			'description' => 'this is account should be at level 3',
			'parent_account' => $account2_2->account_code,
			'account_code' => 'AAA-BB2-CC2',
		]);
    }
}
