<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@lecco.com',
            'password' => bcrypt('123456'),
        ]);

        $user2 = User::create([
            'name' => 'admin2',
            'email' => 'admin2@lecco.com',
            'password' => bcrypt('123456'),
        ]);

         DB::table('access_rights')->insert([
            'user_id' => $user->id,

            'user_view_list' => true,
            'user_delete' => true,
            'invoke_rights' => true,

            'member_view_list' => true,
            'member_view' => true,
            'member_create' => true,
            'member_edit' => true,
            'member_delete' => true,

            'loan_types_view_list' => true,
            'loan_types_view' => true,
            'loan_types_create' => true,
            'loan_types_edit' => true,
            'loan_types_delete' => true,

            'loans_view_list' => true,
            'loans_view' => true,
            'loans_create' => true,
            'loans_edit' => true,
            'loans_delete' => true,

            'chart_of_accounts_view_list' => true,
            'chart_of_accounts_view' => true,
            'chart_of_accounts_create' => true,
            'chart_of_accounts_edit' => true,
            'chart_of_accounts_delete' => true,

            'transactions_view_list' => true,
            'transactions_view' => true,
            'transactions_create' => true,
            'transactions_edit' => true,
            'transactions_delete' => true,

            'shares_view_list' => true,
            'shares_view' => true,
            'shares_create' => true,
            'shares_edit' => true,
            'shares_delete' => true,

            'signatories_view_list' => true,
            'signatories_create' => true,
            'signatories_edit' => true,
            'signatories_delete' => true,

            // 'check_voucher_view' => true,
            // 'check_voucher_create' => true,
            // 'check_voucher_edit' => true,
            // 'check_voucher_delete' => true,
        ]);

          DB::table('access_rights')->insert([
            'user_id' => $user2->id,

            'user_view_list' => true,
            'user_delete' => true,
            'invoke_rights' => true,

            'member_view_list' => true,
            'member_view' => true,
            'member_create' => true,
            'member_edit' => true,
            'member_delete' => true,

            'loan_types_view_list' => true,
            'loan_types_view' => true,
            'loan_types_create' => true,
            'loan_types_edit' => true,
            'loan_types_delete' => true,

            'loans_view_list' => true,
            'loans_view' => true,
            'loans_create' => true,
            'loans_edit' => true,
            'loans_delete' => true,

            'shares_view_list' => true,
            'shares_view' => true,
            'shares_create' => true,
            'shares_edit' => true,
            'shares_delete' => true,

            // 'coa_view' => true,
            // 'coa_create' => true,
            // 'coa_edit' => true,
            // 'coa_delete' => true,

            'signatories_view_list' => true,
            'signatories_create' => true,
            'signatories_edit' => true,
            'signatories_delete' => true,
            
            // 'check_voucher_view' => true,
            // 'check_voucher_create' => true,
            // 'check_voucher_edit' => true,
            // 'check_voucher_delete' => true,
        ]);
    }
}
