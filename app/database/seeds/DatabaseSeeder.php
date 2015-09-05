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

		$tables = [
			'reports',
			'certificates',
			'items',
			'users',
			'roles',
			'clients'
		];

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		foreach ($tables as $table) {
			DB::table($table)->truncate();
		}
		
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
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
