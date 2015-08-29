<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeColumnToCertificatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('certificates', function(Blueprint $table)
		{
			$table->integer('certificate_type_id')->after('cert_no');
			$table->dropColumn('report_id');
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
			$table->dropColumn('certificate_type_id');
		});
	}

}