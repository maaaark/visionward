<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEsportsMatch extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
      Schema::create('esports_match', function(Blueprint $table)
		{
			$table->increments('id');
			$table->datetime('date');
			$table->integer('tournament_id');
			$table->integer('match_id');
			$table->integer('winner');
			$table->string('riot_url');
			$table->integer('max_games');
			$table->integer('is_finished');
			$table->integer('tournament_round');
			$table->integer('team1_id');
			$table->integer('team2_id');
			$table->string('polldaddy_id');
			$table->string('name');
			$table->string('games');
			$table->timestamps();
		});
		
		Schema::create('esports_game', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('game_id');
			$table->integer('winner');
			$table->integer('tournament_id');
			$table->timestamps();
		});
		
		Schema::create('esports_team', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('team_id');
			$table->string('name');
			$table->string('logo_riot');
			$table->string('acronym');
			$table->integer('wins_riot');
			$table->integer('losses_riot');
			$table->timestamps();
		});
	}

}
