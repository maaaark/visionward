<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdsToTeamsAndPlayer extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('players', function(Blueprint $table)
		{
			$table->integer('player_id_riot');
		});

		Schema::table('teams', function(Blueprint $table)
		{
			$table->integer('team_id_riot');
		});
	}

}
