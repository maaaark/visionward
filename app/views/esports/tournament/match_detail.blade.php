@extends('layouts.header_esports')
@section('title', "Esports")
@section('esports_navi_elements')
		@include('esports.tournament.navi')
@stop
@section('opener')
	@include('esports.tournament_header')
@stop
@section('content')
	<script>$(".esports_opener_navi .esports_header_navi .element.matches").addClass("active");</script>
	<h1>Übersicht</h1>
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