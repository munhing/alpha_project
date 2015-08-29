<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCertificateItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('certificate_item', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('certificate_id')->unsigned()->index();
			$table->foreign('certificate_id')->references('id')->on('certificates')->onDelete('cascade');
			$table->integer('item_id')->unsigned()->index();
			$table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
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
		Schema::drop('certificate_item');
	}

}
