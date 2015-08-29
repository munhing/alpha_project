<?php

use Faker\Factory as Faker;

class ItemReportPivotTableSeeder extends Seeder {
 
  	public function run()
  	{

	    $faker = Faker::create();

		DB::table('item_report')->truncate();

		for ($i = 0; $i < 100; $i++)
		{
		  ItemReportPivot::create(array(
		    'item_id' => $faker->numberBetween(1,100),
		    'report_id' => $faker->numberBetween(1,500)
		  ));
		}
	}
}