<?php

use Illuminate\Database\Seeder;
use App\Signatory;

class SignatoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $signatory = Signatory::create([
			'name' => 'Bruno Mars',
			'designation' => 'Singer',
		]);
		
		$signatory = Signatory::create([
			'name' => 'Keanu Go',
			'designation' => 'May ari ng universe',
		]);
		
		$signatory = Signatory::create([
			'name' => 'Jethro Albano',
			'designation' => 'Apostol ni Jo',
		]);
    }
}
