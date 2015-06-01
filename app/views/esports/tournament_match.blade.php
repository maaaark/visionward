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
		<span>> {{ date("d.m.Y", strtotime($match->date)) }}
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
	</div>
</div>