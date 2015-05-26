<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRankedStatsToSummonersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('summoners', function(Blueprint $table)
		{
			$table->string("solo_division")->default("none");
			$table->string("solo_tier")->default("none");
			$table->string("solo_name")->default("none");
			$table->string("team5_division")->default("none");
			$table->string("team5_tier")->default("none");
			$table->string("team5_name")->default("none");
			$table->string("team3_division")->default("none");
			$table->string("team3_tier")->default("none");
			$table->string("team3_name")->default("none");

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('summoners', function(Blueprint $table)
		{
			
		});
	}

}
