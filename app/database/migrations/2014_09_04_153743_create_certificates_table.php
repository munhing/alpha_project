<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('certificates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('cert_no')->unique();
			$table->integer('report_id'); // this may change to string('report_no'). But for testing, it's easier to generate the id
			$table->date('date');
			$table->date('next_inspection');
			$table->integer('validity');
			$table->string('filename');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('certificates');
	}

}
