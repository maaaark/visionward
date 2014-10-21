<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddEnemytipsToChampionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('champions', function(Blueprint $table)
		{
			$table->text("enemytips1");
			$table->text("enemytips2");
			$table->text("enemytips3");
			$table->text("allytips1");
			$table->text("allytips2");
			$table->text("allytips3");
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('champions', function(Blueprint $table)
		{
			
		});
	}

}
