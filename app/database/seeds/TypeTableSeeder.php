<?php

class TypeTableSeeder extends Seeder {
 
  	public function run()
  	{

		//DB::table('type')->truncate();

		ReportType::create(array(
			'type' => 'MPI'
		));

		ReportType::create(array(
			'type' => 'DPI'
		));

		ReportType::create(array(
			'type' => 'TG'
		));

		ReportType::create(array(
			'type' => 'Hydro'
		));						
	}
}