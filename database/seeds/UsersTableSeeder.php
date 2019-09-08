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
            'invoke_rights' => true,
            'user_delete' => true,
            'user_view' => true,
            'user_edit' => true,
            'member_view' => true,
            'member_edit' => true,
            'member_delete' => true,
            'member_create' => true,
            'loan_types_edit' => true,
            'loan_types_view' => true,
            'loan_types_delete' => true,
            'loan_types_create' => true,
            // 'loans_view' => true,
            // 'loans_edit' => true,
            // 'loans_delete' => true,
            // 'loans_create' => true,
            'shares_edit' => true,
            'shares_view' => true,
            'shares_create' => true,
            'shares_delete' => true,
            // 'coa_view' => true,
            // 'coa_create' => true,
            // 'coa_edit' => true,
            // 'coa_delete' => true,
            'signatories_view' => true,
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
            'invoke_rights' => true,
            'user_delete' => true,
            'user_view' => true,
            'user_edit' => true,
            'member_view' => true,
            'member_edit' => true,
            'member_delete' => true,
            'member_create' => true,
            'loan_types_edit' => true,
            'loan_types_view' => true,
            'loan_types_delete' => true,
            'loan_types_create' => true,
            // 'loans_view' => true,
            // 'loans_edit' => true,
            // 'loans_delete' => true,
            // 'loans_create' => true,
            'shares_edit' => true,
            'shares_view' => true,
            'shares_create' => true,
            'shares_delete' => true,
            // 'coa_view' => true,
            // 'coa_create' => true,
            // 'coa_edit' => true,
            // 'coa_delete' => true,
            'signatories_view' => true,
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
