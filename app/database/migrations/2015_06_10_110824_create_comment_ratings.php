<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentRatings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('champions_stats', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user');
			$table->integer('comment');
			$table->string('type');
			$table->timestamps();
		});
	}

}
