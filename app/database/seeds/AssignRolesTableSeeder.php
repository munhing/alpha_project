<?php

class AssignRolesTableSeeder extends Seeder {
 
  	public function run()
  	{

		//DB::table('type')->truncate();

		$adminuser = User::find(1);
		
		$admin = Role::find(1);
	 
		$adminuser->attachRole($admin);

		$clientuser = User::find(2);
		
		$client = Role::find(3);
	 
		$clientuser->attachRole($client);		
	}
}