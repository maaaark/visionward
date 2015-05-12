<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShowStandingsOnFrontToEsportsLeague extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('esports_tournament', function(Blueprint $table)
		{
			$table->integer('show_standings_on_front');
		});
	}

}
