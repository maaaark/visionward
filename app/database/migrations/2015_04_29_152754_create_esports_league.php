<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEsportsLeague extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('esports_league', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('league_id');
			$table->string('name');
			$table->string('short_name');
			$table->integer('default_tournament');
			$table->integer('default_series');
			$table->string('league_tournaments');
			$table->string('riot_url');
			$table->string('label');
			$table->integer('published_riot');
			$table->timestamps();
		});
	}

}
