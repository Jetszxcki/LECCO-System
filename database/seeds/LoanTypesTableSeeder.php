<?php

use Illuminate\Database\Seeder;

use App\LoanType;

class LoanTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loan_type = LoanType::create([
			'name' => 'Multi-purpose Loan',
			'amount_minimum' => 20000.00,
			'amount_maximum' => 150000.00,
			'payment_period_minimum' => 24,
			'payment_period_maximum' => 24,
			'interest_per_annum' => .175,
		]);
		
		
		$loan_type = LoanType::create([
			'name' => 'Calamity Loan',
			'amount_minimum' => 0.00,
			'amount_maximum' => 35000.00,
			'payment_period_minimum' => 12,
			'payment_period_maximum' => 24,
			'interest_per_annum' => .09,
		]);
		
		$loan_type = LoanType::create([
			'name' => 'Medical Loan',
			'amount_minimum' => 0.00,
			'amount_maximum' => 30000.00,
			'payment_period_minimum' => 12,
			'payment_period_maximum' => 12,
			'interest_per_annum' => .01,
		]);
		
		$loan_type = LoanType::create([
			'name' => 'Motorcycle Loan',
			'amount_minimum' => 0.00,
			'amount_maximum' => 0.00,
			'payment_period_minimum' => 36,
			'payment_period_maximum' => 36,
			'interest_per_annum' => .175,
		]);
		
		$loan_type = LoanType::create([
			'name' => 'Vehicle Loan',
			'amount_minimum' => 200000.00,
			'amount_maximum' => 250000.00,
			'payment_period_minimum' => 60,
			'payment_period_maximum' => 60,
			'interest_per_annum' => .2,
		]);
		
		
		$loan_type = LoanType::create([
			'name' => 'Business Loan',
			'amount_minimum' => 0.00,
			'amount_maximum' => 250000.00,
			'payment_period_minimum' => 60,
			'payment_period_maximum' => 62,
			'interest_per_annum' => .1,
		]);
		
		$loan_type = LoanType::create([
			'name' => 'Housing Loan',
			'amount_minimum' => 10000.00,
			'amount_maximum' => 150000.00,
			'payment_period_minimum' => 36,
			'payment_period_maximum' => 36,
			'interest_per_annum' => .09,
		]);
		
		$loan_type = LoanType::create([
			'name' => 'Educational Loan',
			'amount_minimum' => 5000.00,
			'amount_maximum' => 35000.00,
			'payment_period_minimum' => 12,
			'payment_period_maximum' => 12,
			'interest_per_annum' => .1,
		]);
		
		$loan_type = LoanType::create([
			'name' => 'Electronic and Appliance Loan',
			'amount_minimum' => 0,
			'amount_maximum' => 50000.00,
			'payment_period_minimum' => 5,
			'payment_period_maximum' => 24,
			'interest_per_annum' => .12,
		]);
    }
}
