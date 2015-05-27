<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeaturedcontentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('featuredContents', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('filename');
			$table->string('extension');
			$table->string('url');
			$table->string('headline');
			$table->string('destination');
			$table->string('published');
			$table->string('sort');
			$table->string('order');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('featuredcontents');
	}

}
