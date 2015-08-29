<?php

use Faker\Factory as Faker;
use Carbon\Carbon;

class CertificatesTableSeeder extends Seeder {
 
  	public function run()
  	{

	    $faker = Faker::create();

		// $id = DB::select(DB::raw("SELECT * FROM clients, 
  //   			(SELECT RAND() * (SELECT MAX(id) FROM clients) AS tid) AS tmp
		// 		WHERE clients.id = round(tmp.tid)"));

		// if($id[0]->id == 0) {$id[0]->id=1;}


		//dd($report->client->id);

		for ($i = 0; $i < 500; $i++)
		{

		    $reportId = $faker->numberBetween(1,500);

			$report = Report::with('client')->find($reportId);

			$fakerDate = $faker->dateTimeBetween('-4 years', 'now');

			$last_inspection = Carbon::createFromFormat('Y-m-d', $fakerDate->format('Y-m-d'));
			$next_inspection = clone $last_inspection;
			
			$type = $faker->randomElement($array = array ('MPI', 'DPI', 'TG', 'Hydro'));
			
			$validity = $faker->randomElement($array = array (12, 24, 36, 48));
			$year = ['12'=>1, '24'=>2, '36'=>3, '48'=>4];
			//dd($year[$validity]);

		  Certificate::create(array(
		    'cert_no' => strtoupper($faker->unique()->bothify('TUV/?/??/##/0#####')),
		    'client_id' => $report->client->id,
		    'report_id' => $reportId,
		    'date' => $last_inspection,
		    'next_inspection' => $next_inspection->addYears($year[$validity])->subDay(),
		    'validity' => $validity
		  ));
		}
		
		  Certificate::create(array(
			'cert_no' => 'TUV/L/PR/14/080364',
			'client_id' => 51,
			'report_id' => 501,
			'date' => '2014-08-11',
			'next_inspection' => '2015-08-10',
			'validity' => 12,
			'filename' => 'TestReport.pdf'
		  ));

		  Certificate::create(array(
			'cert_no' => 'TUV/L/PR/14/080365',
			'client_id' => 51,
			'report_id' => 502,
			'date' => '2014-08-11',
			'next_inspection' => '2015-08-10',
			'validity' => 12,
			'filename' => 'TestReport.pdf'
		  ));		

		  Certificate::create(array(
			'cert_no' => 'TUV/L/PR/14/080709',
			'client_id' => 51,
			'report_id' => 503,
			'date' => '2014-08-15',
			'next_inspection' => '2015-08-14',
			'validity' => 12,
			'filename' => 'TestReport.pdf'
		  ));	

		  Certificate::create(array(
			'cert_no' => 'TUV/L/PR/14/080726',
			'client_id' => 51,
			'report_id' => 504,
			'date' => '2014-08-15',
			'next_inspection' => '2015-08-14',
			'validity' => 12,
			'filename' => 'TestReport.pdf'
		  ));		  
	}
}
	