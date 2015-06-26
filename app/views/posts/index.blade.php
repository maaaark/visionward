@extends('layouts.master')
@section('title', "League of Legends News und eSport Coverage")
@section('content')
    @foreach($global_settings as $setting)
		<?php
			$settingsArray[$setting->key] = $setting->value;  
		?>
	@endforeach
	
	@if(isset($live_match) AND $live_match AND isset($live_match["tournament_id"]) AND $live_match["tournament_id"] > 0)
        <?php
            $team1 = Helpers::getTeamData($live_match["team1_id"]);
            $team2 = Helpers::getTeamData($live_match["team2_id"]);
            $tournament = Helpers::getTournamentData($live_match["tournament_id"]);
        ?>
        
        @if(isset($team1["team_id"]) AND $team1["team_id"] > 0 AND isset($team2["team_id"]) AND $team2["team_id"] > 0 AND isset($tournament["tournament_id"]) AND $tournament["tournament_id"] > 0)
        <h2 class="headline">Gerade Live:</h2>
        <div class="index_esports_live_link">
            <div class="top_bar">Gerade Live: {{ $team1["name"] }} gegen {{ $team2["name"] }} | {{ $tournament["name"] }}</div>
            <div class="team_col first">
                <img src="{{ $team1['logo_riot'] }}" class="team_icon">
                <div class="team_name">{{ $team1["name"] }}</div>
            </div>
            <div class="team_col second">
                <img src="{{ $team2['logo_riot'] }}" class="team_icon">
                <div class="team_name">{{ $team2["name"] }}</div>
            </div>
            
            <div class="center_col">
                <div class="vs">vs.</div>
                <button class="esports_button" onclick="self.location.href = '/esports'">Zum Esports-Bereich</button>
            </div>
        </div>
        @endif
    @endif
	
	@if($settingsArray['eil_switch'] === "1")
        <h2 class="headline">EILMELDUNG</h2>
        <div class="eilmeldung">
            <marquee>{{ $settingsArray['eilmeldung'] }}</marquee>
        </div>
    @endif

	<h2 class="headline">Aktuelle League of Legends News</h2>
	<ul class="news_list">
		<?php 
			$i=1;
			$x=1;
		?>
			@foreach($posts as $post)
				<li>
					@if($i<=3)
						<div class="news article">
							  <div class="row">
							  <div class="col-sm-3 col-md-3 hidden-xs"><a href="/news/{{ $post->id }}/{{ $post->slug }}"><img src="<?=Croppa::url('/uploads/news/'.$post->image, null, 100)?>" alt="{{ $post->title }}" width="100%" /></a></div>
							  <div class="col-sm-9 col-md-9 text">
								<h2><a href="/news/{{ $post->id }}/{{ $post->slug }}">{{ $post->title }}</a></h2>
								{{ $post->excerpt }}
								<div class="meta">
									<span class="comments_count"><a class="disqus-comment-count" href="/news/{{ $post->id }}/{{ $post->slug }}">{{ $post->comments->count() }} Kommentare</a></span> - <a href="/users/{{ $post->user->username }}">{{ $post->user->username }}</a> - {{ $post->created_at->format('d.m.Y') }} - {{ $post->created_at->format('H:i') }} Uhr
								</div>
							  </div>
							  <div class="clear"></div>
							</div>
						</div>
					@else
						<div class="row">
							<div class="col-md-12">
							@if($x == 1)
								<?php $class="grey"; $x=0; ?>
							@else
								<?php $class=""; $x=1; ?>
							@endif
							<table class="news_small">
								<tr class="{{ $class }}">
									<td width="40"><a href="/news/{{ $post->id }}/{{ $post->slug }}"><img src="<?=Croppa::url('/uploads/news/'.$post->image, 50, null)?>" alt="{{ $post->title }}" style="margin-left: 10px;margin-right: 10px;" /></a></td>
									<td width="90"><span class="meta">{{ Helpers::diffForHumans($post->created_at) }}&nbsp;&nbsp;</span></td>
									<td width="80"><span class="comments_count"><a class="disqus-comment-count" href="/news/{{ $post->id }}/{{ $post->slug }}">{{ $post->comments->count() }} Kommentare</a></span></td>
									<td><a class="small_headline" href="/news/{{ $post->id }}/{{ $post->slug }}">{{ $post->title }}</a></td>
								</tr>
							</table>
							</div>
						</div>
					@endif
				</li>
				<?php $i++; ?>
			@endforeach
	</ul>
	<a href="/news/archive" class="pagination button" style="text-decoration: none;">News-Archive</a>
@stop