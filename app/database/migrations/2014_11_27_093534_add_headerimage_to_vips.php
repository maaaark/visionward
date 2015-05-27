<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddHeaderimageToVips extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('vips', function(Blueprint $table)
		{
			$table->string("header_image");
			$table->string("summoner");
			$table->string("region");
			$table->string("country");
			$table->string("twitter");
			$table->string("facebook");
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('vips', function(Blueprint $table)
		{
			
		});
	}

}
