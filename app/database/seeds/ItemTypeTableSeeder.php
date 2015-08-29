<?php

class ItemTypeTableSeeder extends Seeder {
 
  	public function run()
  	{

		//DB::table('item_type')->truncate();

		ItemType::create(array(
			'type' => 'Mini Container'
		));

		ItemType::create(array(
			'type' => 'Mud Skip / Cutting Box'
		));

		ItemType::create(array(
			'type' => 'Cargo Baskets'
		));

		ItemType::create(array(
			'type' => 'Closed Container'
		));	

		ItemType::create(array(
			'type' => 'Open Top Container'
		));

		ItemType::create(array(
			'type' => 'Garbage Container'
		));		

		ItemType::create(array(
			'type' => 'IBC Carrier'
		));

		ItemType::create(array(
			'type' => 'Bottle Rack'
		));

		ItemType::create(array(
			'type' => '4 Legged Sling'
		));	

		ItemType::create(array(
			'type' => '5 Legged Sling'
		));		

	}
}