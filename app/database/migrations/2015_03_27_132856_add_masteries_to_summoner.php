<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMasteriesToSummoner extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('summoners', function(Blueprint $table)
		{
			$table->text('masteries_data');
			$table->dateTime('last_update_masteries');
		});
	}

}
