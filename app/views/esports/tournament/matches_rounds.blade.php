@extends('layouts.design_main')
@section('title', $tournament->name." - Matches - Esports")
@section('esports_navi_elements')
		@include('esports.tournament.navi')
@stop
@section('opener')
	@include('esports.tournament_header')
@stop
@section('content')
	<?php
		$rounds_count = count($spieltage);
		$tab_width	  = round(100 / intval($rounds_count), 5);
	?>
	
	<div class="spieltag_tabs">
		@foreach($spieltage as $spieltag)
			<div class="spieltag_tab spieltag_val{{ $spieltag["tournament_round"] }}" data-spieltag="{{ $spieltag["tournament_round"] }}" style="width: {{ $tab_width }}%">{{ $spieltag["tournament_round"] }}</div>
		@endforeach
		<div style="clear: both;"></div>
	</div>

	<?php
		$last_day = false;
		$status   = false;
	?>
	<div class="matches_container"> 
		<?php
			$last_day = false;
			$status   = false;
		?>
		@foreach($matches as $match)
			<?php $wrote_something_past = true; ?>
			@if(date("d.m.y", strtotime($match->date)) != $last_day)
				@if($status)
					</div>
					</div>
				@endif
				<div class="match_box_holder spieltag_match spieltag{{ $match["tournament_round"] }}" data-spieltag="{{ $match["tournament_round"] }}"><div class="bg">
				<?php
					$status 	 = true;
					$last_day 	 = date("d.m.y", strtotime($match->date));
					$day_of_week = date("w", strtotime($match->date));
				?>
				<div class="date_title">
					@if($day_of_week == 0)Sonntag
					@elseif($day_of_week == 1)Montag
					@elseif($day_of_week == 2)Dienstag
					@elseif($day_of_week == 3)Mittwoch
					@elseif($day_of_week == 4)Donnerstag
					@elseif($day_of_week == 5)Freitag
					@elseif($day_of_week == 6)Samstag
					@endif
					<span>> {{ date("d.m.Y", strtotime($match->date)) }}</span>
				</div>
			@endif
			
			@if($match->is_finished != 1)
				<div style="display: none;" class="not_played_yet">true</div>
			@endif
			<div class="match_box clickable" onclick="self.location.href='/esports/{{ str_replace(" ", "_", trim(strtolower($league->short_name))) }}/tournament/{{ $tournament->tournament_id }}/match/{{ $match->match_id }}'">
				<div class="top_bar">
					Best of {{ $match->max_games }}
					@if($match->date)
						<div class="date">{{ date("H:i", strtotime($match->date)) }} Uhr</div>
					@endif
				</div>
				<div class="match_content">
					@if($match->team1_id == 0 AND $match->team2_id == 0)
						<div class="no_teams">Die Teams sind bis jetzt noch nicht bekannt.</div>
					@else
						<?php
							$team1 = Helpers::getTeamData($match->team1_id);
							$team2 = Helpers::getTeamData($match->team2_id);
						?>
						<div class="team2 team_logo" style="background-image:url({{ $team2["logo_riot"] }});"></div>
						<div class="team2_info team_info">
							<div><a href="/esports/team/{{ trim(strtolower($team2["acronym"])) }}">{{ $team2["name"] }}</a></div>
							<div class="win_infos">
								<div>{{ Helpers::getTournamentTeamWins($tournament["tournament_id"], $team2["team_id"]) }} gewonnen</div>
								<div>{{ Helpers::getTournamentTeamLosses($tournament["tournament_id"], $team2["team_id"]) }} verloren</div>
							</div>
						</div>
						<div class="team1_info team_info">
							<div><a href="/esports/team/{{ trim(strtolower($team1["acronym"])) }}">{{ $team1["name"] }}</a></div>
							<div class="win_infos">
								<div>{{ Helpers::getTournamentTeamWins($tournament["tournament_id"], $team1["team_id"]) }} gewonnen</div>
								<div>{{ Helpers::getTournamentTeamLosses($tournament["tournament_id"], $team1["team_id"]) }} verloren</div>
							</div>
						</div>
						<div class="team1 team_logo" style="background-image:url({{ $team1["logo_riot"] }});"></div>
					@endif
				</div>
			</div>
		@endforeach
		</div>
		</div>
	</div>

	<script>
	$(document).ready(function(){
		$(".spieltag_tabs .spieltag_tab").click(function(){
			$(".matches_container .show").removeClass("show");
			$(".matches_container .match_box_holder.spieltag"+$(this).attr("data-spieltag").trim()).addClass("show");
			$(".spieltag_tabs .show").removeClass("show");
			$(this).addClass("show");
		});

		var already_set_start = false;
		$(".matches_container .match_box_holder").each(function(){
			if(already_set_start == false){
				check_not_played = $(this).find(".not_played_yet");
				if(check_not_played != "undefined" && check_not_played && check_not_played.html() == "true"){
					$(".matches_container .match_box_holder.spieltag"+$(this).attr("data-spieltag").trim()).addClass("show");
					$(".spieltag_tabs .spieltag_tab.spieltag_val"+$(this).attr("data-spieltag").trim()).addClass("show");
					already_set_start = true;
				}
			} else {
				$(".spieltag_tabs .spieltag_tab.spieltag_val"+$(this).attr("data-spieltag").trim()).addClass("not_played");
			}
		});

		if(already_set_start == false){
			console.log("asd");
			temp = null;
			$(".spieltag_tabs .spieltag_tab").each(function(){
				temp = $(this);
			});

			$(".spieltag_tabs .show").removeClass("show");
			temp.addClass("show");
			$(".matches_container .show").removeClass("show");
			$(".matches_container .match_box_holder.spieltag"+temp.attr("data-spieltag").trim()).addClass("show");
		}
	});
	</script>
@stop