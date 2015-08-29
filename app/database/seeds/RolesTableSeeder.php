<?php

class RolesTableSeeder extends Seeder {
 
  	public function run()
  	{

		//DB::table('type')->truncate();

		$role = new Role();
		$role->name = 'Admin';
		$role->save();
	
		$role = new Role();
		$role->name = 'Staff';
		$role->save();

		$role = new Role();
		$role->name = 'Client';
		$role->save();		
		
	}
}