<?php

use Faker\Factory as Faker;

class ClientsTableSeeder extends Seeder {
 
  	public function run()
  	{

	    $faker = Faker::create();

		//DB::table('clients')->truncate();

		Client::create(array(
			'name' => 'Alpha Testing Services Sdn. Bhd.'
		));	
		
		for ($i = 0; $i < 49; $i++)
		{
		  Client::create(array(
		    'name' => $faker->unique()->company
		  ));
		}
		
		Client::create(array(
			'name' => 'Swire Oilfield Services'
		));		
		
	}
}