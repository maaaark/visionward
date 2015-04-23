<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreinfosToMasteries extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('masteries', function(Blueprint $table)
		{
			$table->integer('ranks');
			$table->string('prereq');
		});
	}

}
