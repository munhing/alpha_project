<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemReportTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item_report', function(Blueprint $table)
		{
			$table->integer('item_id')->unsigned();
			$table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
			$table->integer('report_id')->unsigned();
			$table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('item_report');
	}

}
