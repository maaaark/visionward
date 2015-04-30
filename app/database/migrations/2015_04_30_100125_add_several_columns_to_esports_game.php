<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeveralColumnsToEsportsGame extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('esports_game', function(Blueprint $table)
		{
			$table->integer('game_number');
			$table->integer('game_length');
			$table->integer('match_id');
			$table->integer('max_games');
			$table->integer('tournament_round');
			$table->string('youtube_video');
			$table->integer('blueteam_id');
			$table->integer('redteam_id');
			$table->text('players');
		});
	}

}
