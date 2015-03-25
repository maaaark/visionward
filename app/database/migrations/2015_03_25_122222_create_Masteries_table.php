<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasteriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('masteries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer("mastery_id");
			$table->string("name");
			$table->string("mastery_tree");
			$table->string("description");
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
		Schema::drop('masteries');
	}

}
