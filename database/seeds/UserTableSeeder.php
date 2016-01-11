<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    User::create(array('name' => 'Jesse Parker',
		    'email' => 'jparker1@crimson.ua.edu',
		    'password' => Hash::make('password')));
    }
}
