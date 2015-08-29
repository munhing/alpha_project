<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCertificateReportTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('certificate_report', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('certificate_id')->unsigned()->index();
			$table->foreign('certificate_id')->references('id')->on('certificates')->onDelete('cascade');
			$table->integer('report_id')->unsigned()->index();
			$table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
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
		Schema::drop('certificate_report');
	}

}
