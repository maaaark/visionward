<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLolChampionsStatsTables extends Migration {

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
			$table->integer('champion');
			$table->string('patch', 20);
			$table->string('region', 5);
			$table->string('season', 20);
			$table->integer('matches_count');
			$table->float('wins');
			$table->float('kills');
			$table->float('deaths');
			$table->float('assists');
			$table->float('lasthits');
			$table->float('lasthits_jungle');
			$table->float('lasthits_jungle_team');
			$table->float('lasthits_jungle_enemy');
			$table->float('gold_earned');
			$table->float('gold_spent');
			$table->timestamps();
		});

		Schema::create('champions_stats_bans', function(Blueprint $table){
			$table->increments('id');
			$table->integer('champion');
			$table->string('patch', 20);
			$table->string('region', 5);
			$table->integer("bans");
			$table->integer("ban_1");
			$table->integer("ban_2");
			$table->integer("ban_3");
			$table->integer("ban_4");
			$table->integer("ban_5");
			$table->integer("ban_6");
			$table->timestamps();
		});

		Schema::create('champions_stats_skillorder', function(Blueprint $table){
			$table->increments('id');
			$table->integer('champion');
			$table->string('patch', 20);
			$table->string('region', 5);
			$table->integer("count");
			$table->integer("level1")->length(1);
			$table->integer("level2")->length(1);
			$table->integer("level3")->length(1);
			$table->integer("level4")->length(1);
			$table->integer("level5")->length(1);
			$table->integer("level6")->length(1);
			$table->integer("level7")->length(1);
			$table->integer("level8")->length(1);
			$table->integer("level9")->length(1);
			$table->integer("level10")->length(1);
			$table->integer("level11")->length(1);
			$table->integer("level12")->length(1);
			$table->integer("level13")->length(1);
			$table->integer("level14")->length(1);
			$table->integer("level15")->length(1);
			$table->integer("level16")->length(1);
			$table->integer("level17")->length(1);
			$table->integer("level18")->length(1);
			$table->timestamps();
		});

		Schema::create('champions_stats_summonerspells', function(Blueprint $table){
			$table->increments('id');
			$table->integer('champion');
			$table->string('patch', 20);
			$table->string('region', 5);
			$table->integer("spell1");
			$table->integer("spell2");
			$table->integer("count");
			$table->integer("wins");
			$table->timestamps();
		});
	}

}
