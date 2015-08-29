<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClientIdToCertificatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('certificates', function(Blueprint $table)
		{
			$table->integer('client_id')->after('cert_no');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('certificates', function(Blueprint $table)
		{
			$table->dropColumn('client_id');
		});
	}

}
