<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRankedWinsToSummonersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('summoners', function(Blueprint $table)
		{
			$table->integer("ranked_wins")->default(0);
			$table->integer("ranked_losses")->default(0);
			$table->integer("teamranked_wins")->default(0);
			$table->integer("teamranked_losses")->default(0);
			$table->integer("unranked_wins")->default(0);
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
