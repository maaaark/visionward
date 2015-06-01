<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomImageToEsportsTeam extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
      Schema::table('esports_team', function(Blueprint $table)
		{
			$table->string('custom_logo');
		});
	}

}
