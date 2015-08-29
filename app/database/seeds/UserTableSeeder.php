<?php

class UserTableSeeder extends Seeder {
 
  	public function run()
  	{

		//DB::table('type')->truncate();

		User::create(array(
			'fullname' => 'Administrator',
			'client_id' => 1,
			'email' => 'admin@example.com',
			'username' => 'admin',
			'password' => 'admin',
			'password_confirmation' => 'admin',
			'confirmed' => 1
		));					
	
		User::create(array(
			'fullname' => 'Swire Staff',
			'client_id' => 51,
			'email' => 'swire@swire.com',
			'username' => 'swire',
			'password' => 'swire',
			'password_confirmation' => 'swire',
			'confirmed' => 1
		));					
	}	
}