@extends('layouts.design_main')
@section('title', "Esports")
@section('esports_navi_elements')
		@include('esports.tournament.navi')
@stop
@section('opener')
	@include('esports.tournament_header')
@stop
@section('content')
	<script>$(".esports_opener_navi .esports_header_navi .element.overview").addClass("active");</script>
	<h1>Übersicht</h1>

	<div class="row">
		<div class="col-md-6">
			<div class="standings_box">
				<div class="title">
					<img src="{{ $league->league_image }}" class="league_icon">
					Tabelle
				</div>
				<?php
					$teams_count = 0;
				?>
				@if(isset($standings) AND count($standings) > 0)
					<table class="standings">
						<thead>
							<th colspan="3"></th>
							<th colspan="2">Spiele</th>
							<th>Punkte</th>
						</thead>
						<tbody>
						@foreach($standings as $element)
							<?php $teams_count++; ?>
							<?php $team_data = Helpers::getTeamData($element["team_id"]); ?>
							<tr>
								<td class="team_icon"><img src="{{ $team_data["logo_riot"] }}" class="team_icon_element"></td>
								<td class="rank">{{ $element->rank }}.</td>
								<td class="team_name"><a href="#">{{ $team_data["name"] }}</a></td>
								<td class="wins">{{ $element->wins }}</td>
								<td class="losses">{{ $element->losses }}</td>
								<td class="points">{{ intval($element->wins * 3) }}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				@else 
					<div style="padding: 25px; color: rgba(0,0,0,0.6); text-align: center;">
						Es ist noch keine Tabelle vorhanden.
					</div>
				@endif
			</div>
		</div>

		<div class="col-md-6">
			<?php
				$played_matches_count = 0;
				$matches_count 		  = 0;

				$kills				  = 0;
				$deaths				  = 0;
				$assists			  = 0;
				$lasthits			  = 0;
				foreach($matches as $match){
					$matches_count++;

					if(isset($match["is_finished"]) && $match["is_finished"] == 1){
						$played_matches_count++;

						// Games bekommen
						$json = json_decode($match["games"], true);
						foreach($json as $game_id){
							$game = Helpers::getGameById($game_id);
							if($game){
								$players = json_decode($game["players"], true);
								if(is_array($players) && count($players > 0)){
									foreach($players as $player){
										if(isset($player["minionsKilled"])){
											$lasthits = $lasthits + $player["minionsKilled"];
										}

										if(isset($player["kills"])){
											$kills = $kills + $player["kills"];
										}

										if(isset($player["deaths"])){
											$deaths = $deaths + $player["deaths"];
										}

										if(isset($player["assists"])){
											$assists = $assists + $player["assists"];
										}
									}
								}
							}
						}
					}
				}
			?>

			<h2 class="heading">Daten</h2>
			<table class="table">
				<tr>
					<td>Teilnehmende Teams</td>
					<td style="width: 35%;">{{ $teams_count }}</td>
				</tr>
				<tr>
					<td>Geplante Matches</td>
					<td>{{ $matches_count }}</td>
				</tr>
				<tr>
					<td>Gespielte Matches</td>
					<td>{{ $played_matches_count }}</td>
				</tr>
			</table>

			<h2 class="heading">Statistik</h2>
			<table class="table">
				<tr>
					<td>Kills</td>
					<td style="width: 35%;">{{ number_format($kills, 0, ",", ".") }}</td>
				</tr>
				<tr>
					<td>Tode</td>
					<td>{{ number_format($deaths, 0, ",", ".") }}</td>
				</tr>
				<tr>
					<td>Assists</td>
					<td>{{ number_format($assists, 0, ",", ".") }}</td>
				</tr>
				<tr>
					<td>Lasthits</td>
					<td>{{ number_format($lasthits, 0, ",", ".") }}</td>
				</tr>
			</table>
		</div>
	</div>
@stop