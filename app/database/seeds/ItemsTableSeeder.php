<?php

use Faker\Factory as Faker;

class ItemsTableSeeder extends Seeder {
 
  	public function run()
  	{

	    $faker = Faker::create();

		//DB::table('items')->truncate();
		$id = DB::select(DB::raw("SELECT * FROM clients, 
    			(SELECT RAND() * (SELECT MAX(id) FROM clients) AS tid) AS tmp
				WHERE clients.id = round(tmp.tid)"));

		if($id == 0) {$id=1;}
		//dd($id);

		for ($i = 0; $i < 100; $i++)
		{

		  	Item::create(array(
		    	'serial_no' => strtoupper($faker->unique()->bothify('???/###')),
		    	'client_id' => $faker->numberBetween(2,50),
		    	'item_type_id' => $faker->numberBetween(1,10),
		    	'description' => $faker->paragraph(3),
		    	'group' => $faker->numberBetween(0,50)
		  	));
		}
		
		$i = Item::create(array(
			'serial_no' => 'BRD/042',
			'client_id' => 51,
			'item_type_id' => 8,
			'description' => $faker->paragraph(3),
			'group' => $faker->numberBetween(0,50)
		));	
		
		$i->reports()->attach(501);

		$i = Item::create(array(
			'serial_no' => 'CBV/238',
			'client_id' => 51,
			'item_type_id' => 1,
			'description' => $faker->paragraph(3),
			'group' => $faker->numberBetween(0,50)
		));	
		$i->reports()->attach(503);

		$i = Item::create(array(
			'serial_no' => 'UK02B/00033',
			'client_id' => 51,
			'item_type_id' => 10,
			'description' => $faker->paragraph(3),
			'group' => $faker->numberBetween(0,50)
		));		
		$i->reports()->attach(502);
		
		$i = Item::create(array(
			'serial_no' => 'UKBBF/921',
			'client_id' => 51,
			'item_type_id' => 10,
			'description' => $faker->paragraph(3),
			'group' => $faker->numberBetween(0,50)
		));	
		$i->reports()->attach(502);
		
		$i = Item::create(array(
			'serial_no' => 'UKBBF/922',
			'client_id' => 51,
			'item_type_id' => 10,
			'description' => $faker->paragraph(3),
			'group' => $faker->numberBetween(0,50)
		));			
		$i->reports()->attach(502);
		
		$i = Item::create(array(
			'serial_no' => 'UKBBF/923',
			'client_id' => 51,
			'item_type_id' => 10,
			'description' => $faker->paragraph(3),
			'group' => $faker->numberBetween(0,50)
		));	
		$i->reports()->attach(502);

		$i = Item::create(array(
			'serial_no' => 'UKBBF/924',
			'client_id' => 51,
			'item_type_id' => 10,
			'description' => $faker->paragraph(3),
			'group' => $faker->numberBetween(0,50)
		));	
		$i->reports()->attach(502);

		$i = Item::create(array(
			'serial_no' => 'UK15B/00181',
			'client_id' => 51,
			'item_type_id' => 9,
			'description' => $faker->paragraph(3),
			'group' => $faker->numberBetween(0,50)
		));	
		$i->reports()->attach(504);

		$i = Item::create(array(
			'serial_no' => 'UKEEA/899',
			'client_id' => 51,
			'item_type_id' => 9,
			'description' => $faker->paragraph(3),
			'group' => $faker->numberBetween(0,50)
		));	
		$i->reports()->attach(504);

		$i = Item::create(array(
			'serial_no' => 'UKEEA/900',
			'client_id' => 51,
			'item_type_id' => 9,
			'description' => $faker->paragraph(3),
			'group' => $faker->numberBetween(0,50)
		));	
		$i->reports()->attach(504);

		$i = Item::create(array(
			'serial_no' => 'UKEEA/901',
			'client_id' => 51,
			'item_type_id' => 9,
			'description' => $faker->paragraph(3),
			'group' => $faker->numberBetween(0,50)
		));		
		$i->reports()->attach(504);

		$i = Item::create(array(
			'serial_no' => 'UKEEA/902',
			'client_id' => 51,
			'item_type_id' => 9,
			'description' => $faker->paragraph(3),
			'group' => $faker->numberBetween(0,50)
		));		
		$i->reports()->attach(504);
	}
}