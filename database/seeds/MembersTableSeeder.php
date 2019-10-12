<?php

use Illuminate\Database\Seeder;

use App\Member;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $member = Member::create([
            'first_name' => 'Bobda',
            'last_name' => 'Builder',
            'birthday' => date('Y-m-d', strtotime('-20 year')),
            'gender' => 'required',
            'civil_status' => 'required',
            'religion' =>'required',
            'highest_educational_attainment' => 'required',
            'no_of_dependents' => '0',
            'residential_address' => 'required',
            'TIN' => 'required',
            'employer' => 'required',
            'department' => 'required',
            'position' => 'required',
            'annual_income' => '0',
            'length_of_service(years)' => '0',
            'status_of_employment' => 'required',
            'no_of_subscribed_shares' => '0',
            'years_to_fully_pay' => '0',
            'contact_no' => 'required',
            'date_accepted' => date('Y-m-d'),
            'BOD_resolution_number' => 'required',
            'type_of_membership' => 'required'
        ]);
		
		$member = Member::create([
            'first_name' => 'Hoge',
            'last_name' => 'Hoge',
            'birthday' => date('Y-m-d', strtotime('-20 year')),
            'gender' => 'required',
            'civil_status' => 'required',
            'religion' =>'required',
            'highest_educational_attainment' => 'required',
            'no_of_dependents' => '0',
            'residential_address' => 'required',
            'TIN' => 'required',
            'employer' => 'required',
            'department' => 'required',
            'position' => 'required',
            'annual_income' => '0',
            'length_of_service(years)' => '0',
            'status_of_employment' => 'required',
            'no_of_subscribed_shares' => '0',
            'years_to_fully_pay' => '0',
            'contact_no' => 'required',
            'date_accepted' => date('Y-m-d'),
            'BOD_resolution_number' => 'required',
            'type_of_membership' => 'required'
        ]);
    }
}
