<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table ('privileges')->insert([
	    	'name' => 'Admin',
		    'description' => 'Administrator',
	    ]);

	    DB::table ('privileges')->insert([
		    'name' => 'Editor',
		    'description' => 'Back end Editor',
	    ]);

	    DB::table ('privileges')->insert([
		    'name' => 'Author',
		    'description' => 'Front end Author',
	    ]);


	    DB::table('users')->insert([
	    	'first_name' => 'Bob',
		    'last_name' => 'Loblaw',
		    'email' => 'bob@bob.com',
		    'password' => bcrypt('abc123')
	    ]);

	    DB::table('privilege_user')->insert([
		    'privilege_id' => 1,
		    'user_id' => 1
	    ]);

	    DB::table('privilege_user')->insert([
		    'privilege_id' => 2,
		    'user_id' => 1
	    ]);

	    DB::table('privilege_user')->insert([
		    'privilege_id' => 3,
		    'user_id' => 1
	    ]);
    }
}
