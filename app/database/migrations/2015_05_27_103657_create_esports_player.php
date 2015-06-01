<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEsportsPlayer extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('esports_player', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('player_id');
			$table->string("name");
			$table->string("role");
			$table->integer("is_starter");
			$table->integer("team_id");
			$table->timestamps();
		});
	}

}
