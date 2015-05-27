<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMatchhistoryAndRunesToSummoners extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('summoners', function(Blueprint $table)
		{
			$table->text('ranked_stats');
			$table->dateTime('last_update_ranked_stats');
			$table->text('runes');
			$table->dateTime('last_update_runes');
		});
	}

}
