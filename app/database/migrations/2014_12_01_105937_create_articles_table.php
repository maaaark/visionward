<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('slug');
			$table->text('content');
			$table->boolean('corrected');
			$table->string('image');
			$table->text('excerpt');
			$table->boolean('published');
			$table->integer('user_id');
			$table->integer('gallery_id');
			$table->timestamp('scheduled_time');
			$table->boolean('schedule_check');
			$table->integer('show_autorbox');
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
		Schema::drop('articles');
	}

}
