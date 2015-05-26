<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLeagueInfosToSummoner extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('summoners', function(Blueprint $table)
		{
			$table->text('league_data');
			$table->dateTime('last_update_league');
		});
	}

}
