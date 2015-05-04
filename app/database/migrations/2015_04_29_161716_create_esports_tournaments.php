<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEsportsTournaments extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('esports_tournament', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tournament_id');
			$table->string('name');
			$table->string('name_public');
			$table->integer('is_finished');
			$table->datetime('date_begin');
			$table->datetime('date_end');
			$table->integer('no_vods');
			$table->string('season');
			$table->integer('published_riot');
			$table->integer('winner');
			$table->timestamps();
		});
	}

}
