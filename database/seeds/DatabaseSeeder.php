<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
		$this->call(LoanTypesTableSeeder::class);
		$this->call(SignatoriesTableSeeder::class);
		
		#seeders further indented depend on previous seeder\s
		
		$this->call(MembersTableSeeder::class);
			$this->call(SharesTableSeeder::class);
    }
}
