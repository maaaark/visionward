<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEsportsStandings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('esports_standings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('standings_id');
			$table->integer('tournament_id');
			$table->integer('team_id');
			$table->integer('rank');
			$table->integer('wins');
			$table->integer('losses');
			$table->timestamps();
		});
	}

}
