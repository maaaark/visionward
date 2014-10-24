@extends('layouts.small_header')
@section('title', $player->nickname)
@section('subtitle', $player->team->name)
@section('header_image',"pro_teams.jpg")
@section('content')

	<table width="100%">
		<tr>
			<td width="220" valign="top">
				<img src="/img/players/{{ $player->picture }}" width="200" />
			</td>
			<td>
				<table class="table table-striped">
					<tr>
						<td width="120"><strong>Nickname</strong></td>
						<td>{{ $player->first_name }} '{{ $player->nickname }}' {{ $player->last_name }}</td>
					</tr>
					<tr>
						<td><strong>Rolle</strong></td>
						<td>
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
						</td>
					</tr>
					<tr>
						<td><strong>Team</strong></td>
						<td><a href="/teams/{{ $player->team->id }}/{{ $player->team->name }}">{{ $player->team->name }}</td>
					</tr>
					<tr>
						<td><strong>Geboren in</strong></td>
						<td><img src="/img/flags/{{ $player->country }}.png" /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<h3 class="headline">{{ $player->name }} Beschreibung</h3>
	{{ $player->description }}<br/>
	<br/>
	<table>
		<tr>
			<td width="340" valign="top">
				<h3 class="headline_no_border">Vorherige Teams</h3>
				<table class="table table-striped">
					@foreach($player->history as $history)
					<tr>
						<td><span class="left_team">{{ $history->oldteam->name }}</span> -> <span class="joined_team">{{ $history->team->name }}</span></td>
						<td>{{ $history->join_date }}</td>
					</tr>
					@endforeach
				</table>
			</td>
			<td width="100"></td>
			<td width="340" valign="top">
				<h3 class="headline_no_border">Platzierungen</h3>
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
			</td>
		</tr>
	</table>
	<br/>
	
<br/>
	
@stop