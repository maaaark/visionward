<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDownvotesToCounterpicks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('counterpicks', function(Blueprint $table)
		{
			$table->integer("downvotes")->default(0);
			$table->integer("upvotes")->default(0);
			$table->integer("lane_id");
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('counterpicks', function(Blueprint $table)
		{
			
		});
	}

}
