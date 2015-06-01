<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlayerHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('player_histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('player_id');
			$table->integer('team_id');
			$table->integer('old_team_id');
			$table->timestamp('join_date');
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
		Schema::drop('player_histories');
	}

}
