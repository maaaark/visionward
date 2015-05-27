<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRankedDataToSummoners extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('summoners', function(Blueprint $table)
		{
			$table->dateTime('last_update_maindata');
			$table->text('ranked_data');
			$table->text('teamranked_data');
			$table->text('unranked_data');
			$table->text('ranked_summary');
			$table->text('matchhistory');
			$table->text('last_update_matchhistory');
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
