<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasteriesTree extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('masteries_trees', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('mastery_id');
			$table->integer('prereq');
			$table->integer('row');
			$table->integer('column');
			$table->string('type');
			$table->timestamps();
		});
	}

}
