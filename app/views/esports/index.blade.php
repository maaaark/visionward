@extends('layouts.design_main')
@section('title', "Esports")
@section('opener')
   <div class="esports_opener_navi">
        <div class="holder">
            <a href="/esports/{{ str_replace(" ", "_", trim("LCS")) }}">
                <div class="league_icon" style="background-image: url('http://riot-web-cdn.s3-us-west-1.amazonaws.com/lolesports/s3fs-public/EU_LCS_Logo_RGB_72dpi.png');"></div>
            </a>
            <div class="league_name">
                League of Legends eSports
            </div>
        </div>
   </div>
@stop
@section('content')
    @if(isset($live_match) AND $live_match AND isset($live_match["tournament_id"]) AND $live_match["tournament_id"] > 0)
        
    @endif
    
	@if(isset($standings) AND $standings AND count($standings) > 0)
		<?php
			$col_size = floor(12 / count($standings));
		?>
		<div class="row">
			@foreach($standings as $standing)
				<div class="col-md-{{ trim($col_size) }}">
					<div class="standings_box">
						<div class="title">
							<img src="{{ $standing["league"]->league_image }}" class="league_icon">
							{{ $standing["league"]->label }} <span>> {{ $standing["tournament"]->name }}</span>
						</div>
						@if(isset($standing["standings"]) AND count($standing["standings"]) > 0)
							<table class="standings">
								<thead>
									<th colspan="3"></th>
									<th colspan="2">Spiele</th>
								</thead>
								<tbody>
								@foreach($standing["standings"] as $element)
									<?php $team_data = Helpers::getTeamData($element["team_id"]); ?>
									<tr>
										<td class="team_icon"><img src="{{ $team_data["logo_riot"] }}" class="team_icon_element"></td>
										<td class="rank">{{ $element->rank }}.</td>
										<td class="team_name"><a href="/esports/team/{{ strtolower($team_data["acronym"]) }}">{{ $team_data["name"] }}</a></td>
										<td class="wins">{{ $element->wins }}</td>
										<td class="losses">{{ $element->losses }}</td>
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
			@endforeach
		</div>
	@endif

	<div class="league_images_holder" id="leagues">
		<h2 class="headline">
			Ligen
		</h2>
		<div style="text-align: center;">
		@foreach($leagues as $league)
			<a href="/esports/{{ str_replace(" ", "_", trim(strtolower($league["short_name"]))) }}" style="margin-right: 10px;">
            @if(isset($league["custom_league_image"]) AND trim($league["custom_league_image"]) != "")
               <img src="{{ $league["custom_league_image"] }}" width="85" height="85">
            @else
               <img src="{{ $league["league_image"] }}" width="85" height="85">
            @endif
			</a>
		@endforeach
		</div>
	</div>
    <br/>
	<div class="row" id="matches">
		<div class="col-md-6">
			<div class="standings_box">
				<h2 class="headline">
					Die letzten Spiele
				</h2>
				<div>
				@if(isset($recent_matches) AND $recent_matches AND count($recent_matches) > 0)
					@foreach($recent_matches as $match)
                  <?php
                     $tournament_temp = Helpers::getTournamentData($match["tournament_id"]);
                     $league_temp     = Helpers::getLeagueData($tournament_temp["league_id"]);
                  ?>
						<div class="match_box clickable" onclick="self.location.href='/esports/{{ str_replace(" ", "_", trim(strtolower($league_temp->short_name))) }}/tournament/{{ $tournament_temp->tournament_id }}/match/{{ $match->match_id }}'">
							<div class="top_bar">
								<?php $tournament_info = Helpers::getTournamentData($match->tournament_id) ?>
								Best of {{ $match->max_games }} | {{ $tournament_info->name }}
								@if($match->date)
									<div class="date">{{ date("d.m. - H:i", strtotime($match->date)) }} Uhr</div>
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
									@if(isset($team2["custom_logo"]) AND trim($team2["custom_logo"]) != "")
                              <div class="team2 team_logo" style="background-image:url({{ $team2["custom_logo"] }});"></div>
                           @else
                              <div class="team2 team_logo" style="background-image:url({{ $team2["logo_riot"] }});"></div>
                           @endif
									<div class="team2_info team_info">
										<div><a href="/esports/team/{{ trim(strtolower($team2["acronym"])) }}">{{ $team2["name"] }}</a></div>
										<div class="win_infos">
											<div>{{ Helpers::getTournamentTeamWins($match->tournament_id, $team2["team_id"]) }} gewonnen</div>
											<div>{{ Helpers::getTournamentTeamLosses($match->tournament_id, $team2["team_id"]) }} verloren</div>
										</div>
									</div>
									<div class="team1_info team_info">
										<div><a href="/esports/team/{{ trim(strtolower($team1["acronym"])) }}">{{ $team1["name"] }}</a></div>
										<div class="win_infos">
											<div>{{ Helpers::getTournamentTeamWins($match->tournament_id, $team1["team_id"]) }} gewonnen</div>
											<div>{{ Helpers::getTournamentTeamLosses($match->tournament_id, $team1["team_id"]) }} verloren</div>
										</div>
									</div>
									@if(isset($team1["custom_logo"]) AND trim($team1["custom_logo"]) != "")
                              <div class="team1 team_logo" style="background-image:url({{ $team1["custom_logo"] }});"></div>
                           @else
                              <div class="team1 team_logo" style="background-image:url({{ $team1["logo_riot"] }});"></div>
                           @endif
								@endif
							</div>
						</div>
					@endforeach
				@else
					<div style="text-align: center;color: rgba(0,0,0,0.6);padding: 20px;">Es sind leider momentan keine Spiele bekannt.</div>
				@endif
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="standings_box">
                <h2 class="headline">
					Die n&auml;chsten Spiele
				</h2>
				<div>
				@if(isset($upcoming_matches) AND $upcoming_matches AND count($upcoming_matches) > 0)
					@foreach($upcoming_matches as $match)
						<?php
                     $tournament_temp = Helpers::getTournamentData($match["tournament_id"]);
                     $league_temp     = Helpers::getLeagueData($tournament_temp["league_id"]);
                  ?>
						<div class="match_box clickable" onclick="self.location.href='/esports/{{ str_replace(" ", "_", trim(strtolower($league_temp->short_name))) }}/tournament/{{ $tournament_temp->tournament_id }}/match/{{ $match->match_id }}'">
							<div class="top_bar">
                        <?php $tournament_info = Helpers::getTournamentData($match->tournament_id) ?>
								Best of {{ $match->max_games }} | {{ $tournament_info->name }}
								@if($match->date)
									<div class="date">{{ date("d.m. - H:i", strtotime($match->date)) }} Uhr</div>
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
									@if(isset($team2["custom_logo"]) AND trim($team2["custom_logo"]) != "")
                              <div class="team2 team_logo" style="background-image:url({{ $team2["custom_logo"] }});"></div>
                           @else
                              <div class="team2 team_logo" style="background-image:url({{ $team2["logo_riot"] }});"></div>
                           @endif
									<div class="team2_info team_info">
										<div><a href="/esports/team/{{ trim(strtolower($team2["acronym"])) }}">{{ $team2["name"] }}</a></div>
										<div class="win_infos">
											<div>{{ Helpers::getTournamentTeamWins($match->tournament_id, $team2["team_id"]) }} gewonnen</div>
											<div>{{ Helpers::getTournamentTeamLosses($match->tournament_id, $team2["team_id"]) }} verloren</div>
										</div>
									</div>
									<div class="team1_info team_info">
										<div><a href="/esports/team/{{ trim(strtolower($team1["acronym"])) }}">{{ $team1["name"] }}</a></div>
										<div class="win_infos">
											<div>{{ Helpers::getTournamentTeamWins($match->tournament_id, $team1["team_id"]) }} gewonnen</div>
											<div>{{ Helpers::getTournamentTeamLosses($match->tournament_id, $team1["team_id"]) }} verloren</div>
										</div>
									</div>
									@if(isset($team1["custom_logo"]) AND trim($team1["custom_logo"]) != "")
                              <div class="team1 team_logo" style="background-image:url({{ $team1["custom_logo"] }});"></div>
                           @else
                              <div class="team1 team_logo" style="background-image:url({{ $team1["logo_riot"] }});"></div>
                           @endif
								@endif
							</div>
						</div>
					@endforeach
				@else
					<div style="text-align: center;color: rgba(0,0,0,0.6);padding: 20px;">Es sind leider momentan keine Spiele bekannt.</div>
				@endif
				</div>
			</div>
		</div>
	</div>

	<h2 class="headline">Esports-News</h2>
	<ul class="news_list">
	<?php $post_count = 1; ?>
	@foreach($category->posts as $post)
		@if($post->published == 1 AND $post_count <= 5)
			<li>
				<div class="news">
				  <div class="row">
				  <div class="col-md-3 hidden-xs hidden-sm"><a href="/news/{{ $post->id }}/{{ $post->slug }}"><img src="/uploads/news/{{ $post->image }}" width="100%" /></a></div>
				  <div class="col-md-9 text">
					<h2><a href="/news/{{ $post->id }}/{{ $post->slug }}">{{ $post->title }}</a></h2>
					{{ $post->excerpt }}
					<div class="meta">
						<span class="comments_count"><a href="/news/{{ $post->id }}/{{ $post->slug }}#disqus_thread">0 Kommentare</a></span> {{ $post->created_at->format('d.m.Y') }} - {{ $post->created_at->format('H:i') }} Uhr
					</div>
				  </div>
				  <div class="clear"></div>
				</div>
			</li>
			<?php $post_count++; ?>
		@endif
	@endforeach
	</ul>
@stop