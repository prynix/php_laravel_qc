<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdtypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('adtypes', function(Blueprint $table)
		{
			$table->increments('adtype_id');
			$table->integer('zonetype_id');
			$table->string('title',255);
			$table->string('preview',255);
			$table->integer('width');
			$table->integer('height');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('adtypes');
	}

}
