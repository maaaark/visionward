<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSummonersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('summoners', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('summoner_id');
			$table->string('name');
			$table->integer('profileIconId');
			$table->bigInteger('revisionDate');
			$table->integer('summonerLevel');
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
		Schema::drop('summoners');
	}

}
