<?php

use Faker\Factory as Faker;
use Carbon\Carbon;

class ReportsTableSeeder extends Seeder {
 
  	public function run()
  	{

	    $faker = Faker::create();

		$id = DB::select(DB::raw("SELECT id FROM clients, 
    			(SELECT RAND() * (SELECT MAX(id) FROM clients) AS tid) AS tmp
				WHERE clients.id = round(tmp.tid)"));

		if($id[0]->id == 0) {$id[0]->id=1;}

		//dd($id[0]->id);

		for ($i = 0; $i < 500; $i++)
		{

			$fakerDate = $faker->dateTimeBetween('-4 years', 'now');

			$last_inspection = Carbon::createFromFormat('Y-m-d', $fakerDate->format('Y-m-d'));
			$next_inspection = clone $last_inspection;
			
			$type = $faker->randomElement($array = array ('MPI', 'DPI', 'TG', 'Hydro'));
			
			$validity = $faker->randomElement($array = array (12, 24, 36, 48));
			$year = ['12'=>1, '24'=>2, '36'=>3, '48'=>4];
			//dd($year[$validity]);

		  	Report::create(array(
		    	'report_no' => strtoupper($faker->unique()->bothify('A/??/##/####')),
		    	'type' => $type,
		    	'client_id' => $faker->numberBetween(2,50),
		    	'date' => $last_inspection,
		    	'next_inspection' => $next_inspection->addYears($year[$validity])->subDay(),
		    	'validity' => $validity
		  	));
		}
		
		Report::create(array(
			'report_no' => 'A/MT/14/4213',
			'type' => 'MPI',
			'client_id' => 51,
			'date' => '2014-08-11',
			'next_inspection' => '2018-08-10',
			'validity' => 48,
			'filename' => 'TestReport.pdf'
		));

		Report::create(array(
			'report_no' => 'A/MT/14/4215',
			'type' => 'MPI',
			'client_id' => 51,
			'date' => '2014-08-11',
			'next_inspection' => '2018-08-10',
			'validity' => 48,
			'filename' => 'TestReport.pdf'
		));

		Report::create(array(
			'report_no' => 'A/MT/14/4312',
			'type' => 'MPI',
			'client_id' => 51,
			'date' => '2014-08-15',
			'next_inspection' => '2018-08-14',
			'validity' => 48,
			'filename' => 'TestReport.pdf'
		));

		Report::create(array(
			'report_no' => 'A/MT/14/4313',
			'type' => 'MPI',
			'client_id' => 51,
			'date' => '2014-08-15',
			'next_inspection' => '2018-08-14',
			'validity' => 48,
			'filename' => 'TestReport.pdf'
		));		
	}
}