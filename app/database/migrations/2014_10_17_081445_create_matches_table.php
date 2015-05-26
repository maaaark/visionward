<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matches', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->integer('league_id');
			$table->integer('sub_game');
			$table->integer('bestof');
			$table->integer('team_id_1');
			$table->integer('team_id_2');
			$table->text('description');
			$table->integer('result_team_1');
			$table->integer('result_team_2');
			$table->integer('winner_team_id');
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
		Schema::drop('matches');
	}

}
