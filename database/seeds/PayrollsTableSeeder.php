<?php

use Illuminate\Database\Seeder;

use App\Payroll;

class PayrollsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payroll = Payroll::create(['name' => 'Semi-Monthly Payroll 1',]);
        $payroll = Payroll::create(['name' => 'Semi-Monthly Payroll 2',]);
        $payroll = Payroll::create(['name' => 'RA/LP',]);
    }
}
