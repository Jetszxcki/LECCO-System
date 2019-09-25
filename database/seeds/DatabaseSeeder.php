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
		# Note: Don't forget to arrange seeders based on dependencies
		# Error: ReflectionException  : Class ExampleTableSeeder does not exist (fix: run composer dumpautoload)
        $this->call(UsersTableSeeder::class);
		$this->call(MembersTableSeeder::class);
		$this->call(LoanTypesTableSeeder::class);
		$this->call(PayrollsTableSeeder::class);
		$this->call(SignatoriesTableSeeder::class);
		
		$this->call(SharesTableSeeder::class);
    }
}
