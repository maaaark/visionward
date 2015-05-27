@extends('layouts.header_esports')
@section('title', "Esports")
@section('head_addition')
	<link rel="stylesheet" href="/css/champions/champions.css">
	<script type="text/javascript" src="/js/charts/Chart.js"></script>
@stop
@section('opener')
	<div style="background-image: url({{ asset('img/stats/champion_header/'.$data["key"].'_summoner_bg.jpg') }});" class="champion_header">
		<div class="holder">
			<div class="name">
				<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $data["key"] }}.png" class="champ_icon">
				{{ $data["name"] }}
				<div class="title">{{ $data["title"] }}</div>
			</div>
		</div>
	</div>
@stop

@section('content')
	<div class="row">
		<div class="col col-md-8">
			<h1>Statistiken</h1>
			<table class="table statistics_table">
				<tr>
					<td>Analysierte Spiele</td>
					<td class="val">{{ number_format($stats["matches_count"], 0, ",", ".") }}</td>
				</tr>
				<tr>
					<td>Winrate</td>
					<td class="val">
                  @if(isset($stats["matches_count"]) AND $stats["matches_count"] > 0)
                     {{ str_replace(".", ",", round($stats["wins"] / $stats["matches_count"] * 100, 1)) }}
                  @else
                     0
                  @endif
               </td>
				</tr>
				<tr>
					<td>Kills</td>
					<td class="val">{{ str_replace(".", ",", round($stats["kills"], 2)) }}</td>
				</tr>
				<tr>
					<td>Tode</td>
					<td class="val">{{ str_replace(".", ",", round($stats["deaths"], 2)) }}</td>
				</tr>
				<tr>
					<td>Assists</td>
					<td class="val">{{ str_replace(".", ",", round($stats["assists"], 2)) }}</td>
				</tr>
				<tr>
					<td colspan="2" class="stats_title">Lasthits</td>
				</tr>
				<tr>
					<td>Lasthits</td>
					<td class="val">{{ str_replace(".", ",", round($stats["lasthits"], 2)) }}</td>
				</tr>
				<tr>
					<td>Lasthits Jungle</td>
					<td class="val">{{ str_replace(".", ",", round($stats["lasthits_jungle"], 2)) }}</td>
				</tr>
				<tr>
					<td>Lasthits Team Jungle</td>
					<td class="val">{{ str_replace(".", ",", round($stats["lasthits_jungle_team"], 2)) }}</td>
				</tr>
				<tr>
					<td>Lasthits Gegner Jungle</td>
					<td class="val">{{ str_replace(".", ",", round($stats["lasthits_jungle_enemy"], 2)) }}</td>
				</tr>
			</table>
		</div>
		<div class="col col-md-4">
			<h2>Spielrate pro Patch</h2>
			<canvas id="played_by_patch"></canvas>

			<h2>Winrate pro Patch</h2>
			<canvas id="winrate_by_patch"></canvas>
		</div>
	</div>

	<div class="row">
		<div class="col col-md-8">
			<div class="champion_spells">
				<?php
					$skills_array = array();
					foreach($skills as $skill){
						$skills_array[count($skills_array) + 1] = array("name" => $skill["name"], "id" => $skill["id"], "description" => $skill["description"], "icon" => $skill["icon"]);
					}
				?>

				<h1>Meist genutzte Skillung</h1>
				@for($zeile = 1; $zeile <= 4; $zeile++)
					<div class="spell spell_row{{ $zeile }}">
						<div class="level spell_icon" style="background-image:url(http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/spell/{{ $skills_array[$zeile]["icon"] }});"></div>
						@for($spalte = 1; $spalte <= 18; $spalte++)
							@if(isset($most_used_skillorder["level".$spalte]) AND $most_used_skillorder["level".$spalte] == $zeile)
								<div class="level active">
									@if($most_used_skillorder["level".$spalte] == 1)Q
									@elseif($most_used_skillorder["level".$spalte] == 2)W
									@elseif($most_used_skillorder["level".$spalte] == 3)E
									@elseif($most_used_skillorder["level".$spalte] == 4)R
									@endif
								</div>
							@else
								<div class="level"></div>
							@endif
						@endfor
					</div>
				@endfor
			</div>
		</div>
	</div>

	<script>
		var played_by_patch = {
			labels :   		[
								@for($i = count($playrate) - 1; $i >= 0; $i--)
									{{ $playrate[$i]["patch"] }},
								@endfor
					   		],
			datasets : [
				{
					data :  [
								@for($i = count($playrate) - 1; $i >= 0; $i--)
									{{ $playrate[$i]["value"] }},
								@endfor
							]
				}
			]
		}

		var winrate_by_patch = {
			labels :   		[
								@for($i = count($winrates) - 1; $i >= 0; $i--)
									{{ $winrates[$i]["patch"] }},
								@endfor
					   		],
			datasets : [
				{
					data :  [
								@for($i = count($winrates) - 1; $i >= 0; $i--)
									{{ $winrates[$i]["value"] }},
								@endfor
							]
				}
			]
		}

		window.onload = function(){
			var playrate = document.getElementById("played_by_patch").getContext("2d");
			window.myLine = new Chart(playrate).Line(played_by_patch, {
				responsive: true
			});

			var winrate = document.getElementById("winrate_by_patch").getContext("2d");
			window.myLine = new Chart(winrate).Line(winrate_by_patch, {
				responsive: true
			});
		}
	</script>
@stop