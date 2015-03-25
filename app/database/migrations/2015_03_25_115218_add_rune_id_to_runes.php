<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRuneIdToRunes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('runes', function(Blueprint $table)
		{
			$table->integer('rune_id');
		});
	}
}
