@extends('layouts.design_main')
@section('title', "Esports")
@section('esports_navi_elements')
		@include('esports.tournament.navi')
@stop
@section('opener')
	@include('esports.tournament_header')
@stop
@section('content')
	<script>$(".esports_opener_navi .esports_header_navi .element.matches").addClass("active");</script>

	<div class="match_detail">
		<div class="team1_icon team_icon" style="background-image: url({{ $team1->logo_riot }})"></div>
		<div class="team2_icon team_icon" style="background-image: url({{ $team2->logo_riot }})"></div>

		<div class="info_block">
			@if($team1 AND $team2 AND isset($team1->name) AND isset($team2->name) AND trim($team1->name) != "" AND trim($team2->name) != "")
				<div class="match_name">{{ $team1->name }} gegen {{ $team2->name }}</div>
			@else
				<div class="match_name">Die Teams sind noch nicht bekannt</div>
			@endif

			@if($team1_points == 0 AND $team2_points == 0 || $team1_points == false AND $team2_points == false)
				<div class="match_points_not_played">Das Spiel wurde noch nicht gespielt</div>
			@else
				<div class="match_points">
					<div class="esports_spoiler">{{ $team1_points }} : {{ $team2_points }}</div>
					<button class="esports_button" onclick="$(this).hide();$('.esports_spoiler').show();">Ergebnisse anzeigen</button>
				</div>
			@endif

			@if($team1->team_id == $match->winner)
				<div class="match_winner_team esports_spoiler">{{ $team1->name }} gewinnt</div>
			@elseif($team2->team_id == $match->winner)
				<div class="match_winner_team esports_spoiler">{{ $team2->name }} gewinnt</div>
			@endif
		</div>
		<div style="clear: both;"></div>
	</div>

	@if(trim($games) != "")
		<div class="games_holder" id="games_holder">
			<div id="games_navi" class="games_navi"></div>
			<div style="clear: both;"></div>
			<div id="games_content" class="games_content">{{ $games }}</div>
		</div>

		<script>
		var game_count = 1;
		$("#games_holder #games_content .game_element").each(function(){
			tab_class = "game_tab";
			if(game_count == 1){
				$(this).addClass("open");
				tab_class= "game_tab open";
			}
			$("#games_holder #games_navi").append('<div class="'+tab_class+'" data-gamecount="'+$(this).attr("data-gamecount")+'">Spiel '+game_count+'</div>');
			game_count++;
		});

		$("#games_holder #games_navi .game_tab").click(function(){
			gamecount = $(this).attr("data-gamecount");
			$("#games_holder #games_navi .open").removeClass("open");
			$("#games_holder #games_content .open").removeClass("open");
			$("#games_holder #games_content .game_element#game_element_"+gamecount).addClass("open");
			$(this).addClass("open");
		});
		</script>
	@else
		Es sind noch keine Spiel-Informationen vorhanden
	@endif
@stop