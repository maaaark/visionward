<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeasonchampstatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seasonchampstats', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('summoner_id');
			$table->integer('champion_id');
			$table->integer('wins')->default(0);
			$table->integer('losses')->default(0);
			$table->integer('kills')->default(0);
			$table->integer('deaths')->default(0);
			$table->integer('assists')->default(0);
			$table->integer('creeps')->default(0);

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
		Schema::drop('seasonchampstats');
	}

}
