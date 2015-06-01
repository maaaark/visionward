<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSearchedToSummoner extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->table('summoners', function(Blueprint $table)
		{
            $table->integer("searched")->default(0);
            $table->integer("searched_live")->default(0);
            $table->integer("updated_count")->default(0);
		});
	}

}
