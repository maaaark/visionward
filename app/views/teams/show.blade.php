@extends('layouts.master')
@section('title', $team->name)
@section('header_image',"pro_teams.jpg")
@section('content')
	
	<h2 class="headline">{{ $team->name }} Mitglieder</h2>
	<table width="100%">
		<tr>
			<td width="220" valign="top">
				<img src="/img/teams/logos/{{ $team->logo }}" width="200" /><br/>
			</td>
			<td valign="top">
				<br/>
				<table class="table table-striped">
					@foreach($team->players as $player)
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
	<h3 class="headline">Teilnehmende Ligen</h3>
	<table class="table table-striped">
		@foreach($team->leagues as $league)
		<tr>
			<td><img src="/img/leagues/{{ $league->logo }}" height="20" />&nbsp;&nbsp;<a href="/leagues/{{ $league->id }}/{{ $league->slug }}">{{ $league->name }}</a></td>
		</tr>
		@endforeach
	</table>
	<br/>
	<h3 class="headline">{{ $team->name }} Beschreibung</h3>
	{{ $team->description }}<br/>
	<br/>
	<h3 class="headline">Platzierungen</h3>
	<table class="table table-striped">
		<tr>
			<td width="75"><strong>Platz 1</strong></td>
			<td width="25"><img src="/img/teams/euLCS.png" height="20" /></td>
			<td>LCS Sommer Split 2014</td>
		</tr>
		<tr>
			<td width="75"><strong>Platz 2</strong></td>
			<td width="25"><img src="/img/teams/euLCS.png" height="20" /></td>
			<td>LCS Frühlings Split 2014</td>
		</tr>
	</table>
	<br/>
	
<br/>
	
@stop