@extends('layouts.header_esports')
@section('title', "Esports")
@section('esports_navi_elements')
		<div class="element active">Turnierliste</div>
		@if(isset($league->default_tournament) AND $league->default_tournament > 0)
			<a href="/esports/{{ trim($league_url) }}/tournament/{{ $league->default_tournament }}">
				<div class="element">Zum aktuellen Turnier</div>
			</a>
		@endif
@stop
@section('opener')
	<?php $dont_show_tournaments_dropdown = true; ?>
	@include('esports.tournament_header')
@stop

@section('content')
	<h1>Turnierliste - {{ $league->label }}</h1>
	<div id="league_tournaments_holder" class="league_tournaments">
		<div style="padding: 20px; text-align: center; color: rgba(0,0,0,0.5);">Es wurden noch keine Turniere zu dieser Liga bekanntgegeben</div>
	</div>

	<script>
		var tournament_structure 	 = false;
		var league_holder 			 = $("#league_tournaments_holder");
		var league_tournament_count  = 0;
		function addTournament2DOM(season, id, name){
			if(tournament_structure == false){
				html  = '<div id="tournament_tabs" class="tournament_tabs"></div>';
				html += '<div id="tournament_contents" class="tournament_contents"><div style="clear:both;"></div></div>';
				league_holder.html(html);
				tournament_structure = true;
			}

			season_tab     = league_holder.find("#tournament_tabs .tab[data-season='"+season.trim()+"']");
			if(typeof season_tab.html() == "undefined"){
				league_tournament_count++;
				html  = "<div class='tab' data-season='"+season.trim()+"'>"+season.trim()+"</div>";
				league_holder.find("#tournament_tabs").html(html + league_holder.find("#tournament_tabs").html());

				html  = "<div class='tab_content' data-season='"+season.trim()+"'></div>";
				league_holder.find("#tournament_contents").append(html);
			}

			// Link setzen
			html = "<div data-season='"+season+"'><a href='/esports/{{ trim($league_url) }}/tournament/"+id+"'>"+name+"</a></div>";
			league_holder.find("#tournament_contents .tab_content[data-season='"+season.trim()+"']").append(html);

			league_holder.find("#tournament_contents .active").removeClass("active");
			league_holder.find("#tournament_tabs .active").removeClass("active");
			league_holder.find("#tournament_contents .tab_content[data-season='"+season.trim()+"']").addClass("active");
			league_holder.find("#tournament_tabs .tab[data-season='"+season.trim()+"']").addClass("active");
		}

		@foreach($league_tournaments as $tournament)
			addTournament2DOM("{{ $tournament["season"] }}", {{ $tournament["tournament_id"] }}, "{{ $tournament["name"] }}");
		@endforeach

		$(document).ready(function(){
			$("#league_tournaments_holder #tournament_tabs .tab").click(function(){
				league_holder.find("#tournament_contents .active").removeClass("active");
				league_holder.find("#tournament_tabs .active").removeClass("active");

				$(this).addClass("active");
				league_holder.find("#tournament_contents .tab_content[data-season='"+$(this).attr("data-season").trim()+"']").addClass("active");
			});
		});
	</script>
@stop