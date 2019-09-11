<?php

use Illuminate\Database\Seeder;
use App\Share;

class SharesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		[$total, $price] = [5, 10];
        $loan_type = Share::create([
			'member_id' => '1',
			'total' => $total,
			'price' => $price,
			'amount' => $total*$price,
		]);
		
		[$total, $price] = [3, 10];
        $loan_type = Share::create([
			'member_id' => '1',
			'total' => $total,
			'price' => $price,
			'amount' => $total*$price,
		]);
		
		[$total, $price] = [9, 10];
        $loan_type = Share::create([
			'member_id' => '2',
			'total' => $total,
			'price' => $price,
			'amount' => $total*$price,
		]);
		
		[$total, $price] = [6, 10];
        $loan_type = Share::create([
			'member_id' => '2',
			'total' => $total,
			'price' => $price,
			'amount' => $total*$price,
		]);
		
		
    }
}
