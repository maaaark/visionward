<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPlayersAndChampionsToMatches extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('matches', function(Blueprint $table)
		{
			$table->integer("team1_top_player");
            $table->integer("team2_top_player");
            $table->integer("team1_jungle_player");
            $table->integer("team2_jungle_player");
            $table->integer("team1_mid_player");
            $table->integer("team2_mid_player");
            $table->integer("team1_adc_player");
            $table->integer("team2_adc_player");
            $table->integer("team1_support_player");
            $table->integer("team2_support_player");
            $table->integer("team1_top_champion");
            $table->integer("team2_top_champion");
            $table->integer("team1_jungle_champion");
            $table->integer("team2_jungle_champion");
            $table->integer("team1_mid_champion");
            $table->integer("team2_mid_champion");
            $table->integer("team1_adc_champion");
            $table->integer("team2_adc_champion");
            $table->integer("team1_support_champion");
            $table->integer("team2_support_champion");
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('matches', function(Blueprint $table)
		{
			
		});
	}

}
