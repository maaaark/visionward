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
	<?php 
		$wrote_something_past 	  = false;
		$wrote_something_upcoming = false;
	?>

	<div id="matches_main_holder" class="matches_main_holder"></div>
	@if($matches_upcoming)
		<div class="matches_holder matches_upcoming"> 
		<?php
			$last_day = false;
			$status   = false;
		?>
		@foreach($matches_upcoming as $match)
			<?php $wrote_something_upcoming = true; ?>
			@if(date("d.m.y", strtotime($match->date)) != $last_day)
				@if($status)
					</div>
					</div>
				@endif
				<div class="match_box_holder"><div class="bg">
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

			<div class="match_box">
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
								<div>3 gewonnen</div>
								<div>2 verloren</div>
								<div>9 Punkte</div>
							</div>
						</div>
						<div class="team1_info team_info">
							<div><a href="/esports/team/{{ trim(strtolower($team1["acronym"])) }}">{{ $team1["name"] }}</a></div>
							<div class="win_infos">
								<div>3 gewonnen</div>
								<div>2 verloren</div>
								<div>9 Punkte</div>
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
	@endif

	@if($matches_past)
		<div class="matches_holder matches_past"> 
		<?php
			$last_day = false;
			$status   = false;
		?>
		@foreach($matches_past as $match)
			<?php $wrote_something_past = true; ?>
			@if(date("d.m.y", strtotime($match->date)) != $last_day)
				@if($status)
					</div>
					</div>
				@endif
				<div class="match_box_holder"><div class="bg">
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
								<div>3 gewonnen</div>
								<div>2 verloren</div>
								<div>9 Punkte</div>
							</div>
						</div>
						<div class="team1_info team_info">
							<div><a href="/esports/team/{{ trim(strtolower($team1["acronym"])) }}">{{ $team1["name"] }}</a></div>
							<div class="win_infos">
								<div>3 gewonnen</div>
								<div>2 verloren</div>
								<div>9 Punkte</div>
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
	@endif

	<script>
		console.log("asd");
		@if($wrote_something_past == false && $wrote_something_upcoming == false)
			console.log("test");
			$("#matches_main_holder").html('<div style="padding: 20px;color: rgba(0,0,0,0.5);text-align: center;">Es wurden noch keine Spiele angek&uuml;ndigt :(</div>');
		@elseif($wrote_something_past && $wrote_something_upcoming)
			$(".matches_holder.matches_upcoming").addClass("active");
		@else
			@if($wrote_something_upcoming)
				$("#matches_main_holder").html("<h1>Spiele {{ $tournament["name"] }} <span>> Kommende Spiele</h1>");
				$(".matches_holder.matches_upcoming").addClass("active");
			@else
				$("#matches_main_holder").html("<h1>Spiele {{ $tournament["name"] }} <span>> Gespielte Spiele</h1>");
				$(".matches_holder.matches_past").addClass("active");
			@endif
		@endif
	</script>
@stop