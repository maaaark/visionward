<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeasonrankedstatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seasonrankedstats', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('summoner_id');
			$table->integer('doublekills')->default(0);
			$table->integer('tripplekills')->default(0);
			$table->integer('quadrakills')->default(0);
			$table->integer('pentakills')->default(0);
			$table->integer('losses')->default(0);
			$table->integer('kills')->default(0);
			$table->integer('maxkills')->default(0);
			$table->integer('deaths')->default(0);
			$table->integer('maxdeaths')->default(0);
			$table->integer('assists')->default(0);
			$table->integer('creeps')->default(0);
			$table->integer('neutralcreeps')->default(0);
			$table->integer('games')->default(0);
			$table->integer('gold')->default(0);
			$table->integer('damagetaken')->default(0);
			$table->integer('damage')->default(0);
			$table->integer('season');
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
		Schema::drop('seasonrankedstats');
	}

}
