<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLeagueImageToEsportsLeague extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('esports_league', function(Blueprint $table)
		{
			$table->string('league_image');
		});
	}

}
