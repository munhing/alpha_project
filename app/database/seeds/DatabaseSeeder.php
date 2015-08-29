<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		
  		$this->call('ClientsTableSeeder');
		$this->call('TypeTableSeeder');
		$this->call('ReportsTableSeeder');
		$this->call('CertificatesTableSeeder'); 
		$this->call('UserTableSeeder'); 
		$this->call('ItemTypeTableSeeder');
		$this->call('ItemsTableSeeder');
		
		$this->call('RolesTableSeeder');
		$this->call('AssignRolesTableSeeder');
		
		
		
		//$this->call('ItemReportPivotTableSeeder');
	}

}
