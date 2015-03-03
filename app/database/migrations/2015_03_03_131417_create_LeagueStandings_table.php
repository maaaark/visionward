<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeagueStandingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('league_standings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('team_id');
			$table->integer('league_id');
			$table->integer('rank');
			$table->integer('last_rank');
			$table->integer('wins');
			$table->integer('loss');
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
		Schema::drop('LeagueStandings');
	}

}
