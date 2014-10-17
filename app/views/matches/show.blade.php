@extends('layouts.master')
@section('title', "Team Übersicht")
@section('header_image',"pro_teams.jpg")
@section('content')

<h2 class="headline">{{ $match->team->name }} vs. {{ $match->team2->name }} - {{ $match->league->name }}</h2>

<div class="match_result">
<table class="result_table">
	<tr>
		<td>
			<div class="team_box">
				<img src="/img/teams/logos/{{ $match->team->logo }}" width="150" />
			</div>
				<br/>
				<h2 class="headline">Lineup {{ $match->team->name }}</h2>
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
			<span id="show_result">Ergebnis zeigen</span>
			<span class="hidden_result">
				<h2>1:2</h2>
				{{ $match->winner->name }} gewinnt
			</span>
		</td>
		<td valign="top">
			<div class="team_box">
				<img src="/img/teams/logos/{{ $match->team2->logo }}" width="150" />
			</div>
				<br/>
				<h2 class="headline">Lineup {{ $match->team2->name }}</h2>
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
</div>
<br/>
	
@stop