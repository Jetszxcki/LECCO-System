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
    }
}
