<?php

class TypeTableSeeder extends Seeder {
 
  	public function run()
  	{

		//DB::table('type')->truncate();

		Type::create(array(
			'type' => 'MPI'
		));

		Type::create(array(
			'type' => 'DPI'
		));

		Type::create(array(
			'type' => 'TG'
		));

		Type::create(array(
			'type' => 'Hydro'
		));						
	}
}