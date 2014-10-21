@extends('layouts.small_header')
@section('title', $match->team->name." vs. ".$match->team2->name." - ".$match->league->name)
@section('header_image',"pro_teams.jpg")
@section('content')

<h2 class="headline">{{ $match->team->name }} vs. {{ $match->team2->name }} - {{ $match->league->name }}</h2>

<div class="match_result">
<table class="result_table">
	<tr>
		<td valign="top">
			<div class="team_box">
				<img src="/img/teams/logos/{{ $match->team->logo }}" width="150" />
			</div>
				<br/>
				<h2 class="headline_no_border">Lineup {{ $match->team->name }}</h2>
				<table class="table table-striped">
					@foreach($match->team->players as $player)
					<tr>
						<td width="120"><strong>
							@if($player->role == "top")
								Top-Lane
							@elseif($player->role == "jungle")
								Jungler
							@elseif($player->role == "mid")
								Mid-Lane
							@elseif($player->role == "adcarry")
								AD-Carry
							@elseif($player->role == "support")
								Supporter
							@endif
						</strong></td>
						<td><img src="/img/flags/{{ $player->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $player->id }}/{{ $player->nickname }}">{{ $player->nickname }}</a></td>
					</tr>
					@endforeach
				</table>
			
		</td>
		<td width="200" valign="top" class="result_value">
			
			<h3>vs.</h3>
			@if($match->winner_team_id == 0)
				Noch kein Gewinner eingetragen
			@else
				<span id="show_result">Ergebnis zeigen</span>
				<span class="hidden_result">
					<h2>1:2</h2>
					{{ $match->winner->name }} gewinnt
				</span>
			@endif
		</td>
		<td valign="top">
			<div class="team_box">
				<img src="/img/teams/logos/{{ $match->team2->logo }}" width="150" />
			</div>
				<br/>
				<h2 class="headline_no_border">Lineup {{ $match->team2->name }}</h2>
				<table class="table table-striped">
					@foreach($match->team2->players as $player)
					<tr>
						<td width="120"><strong>
							@if($player->role == "top")
								Top-Lane
							@elseif($player->role == "jungle")
								Jungler
							@elseif($player->role == "mid")
								Mid-Lane
							@elseif($player->role == "adcarry")
								AD-Carry
							@elseif($player->role == "support")
								Supporter
							@endif
						</strong></td>
						<td><img src="/img/flags/{{ $player->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $player->id }}/{{ $player->nickname }}">{{ $player->nickname }}</a></td>
					</tr>
					@endforeach
				</table>
			
		</td>
	</tr>
</table>
<br/>
<h2 class="headline_no_border">Mehr Informationen</h2>
<table class="table table-striped">
	@if($match->title != "")
	<tr>
		<td width="120"><strong>Ttiel</strong></td>
		<td>
			{{ $match->title }}
		</td>
	</tr>
	@endif
	<tr>
		<td width="120"><strong>Liga / Turnier</strong></td>
		<td><a href="/leagues/{{ $match->league->id }}/{{ $match->league->slug }}"><img src="/img/leagues/{{ $match->league->logo }}" height="20" />&nbsp;&nbsp;{{ $match->league->name }} - {{ date("d.m.Y - H:i",strtotime($match->game_date)) }} Uhr</a></td>
	</tr>
	<tr>
		<td width="120"><strong>Modus</strong></td>
		<td>
			Best of {{ $match->bestof }}
		</td>
	</tr>
	<tr>
		<td width="120"><strong>VOD Link</strong></td>
		<td>
			@for($i = 1; $match->bestof >= $i; $i++)
				Match #{{ $i }}<br/>
			@endfor
			<a href="#"></a>
		</td>
	</tr>
</table>
</div>
<br/>
@include("layouts.disqus")	
@stop