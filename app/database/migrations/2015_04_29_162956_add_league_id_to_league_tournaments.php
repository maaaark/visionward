<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLeagueIdToLeagueTournaments extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('esports_tournament', function(Blueprint $table)
		{
			$table->integer('league_id');
		});
	}

}
