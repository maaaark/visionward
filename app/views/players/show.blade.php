@extends('layouts.master')
@section('title', $player->nickname." - ".$player->team->name )
@section('header_image',"pro_teams.jpg")
@section('content')
	
	<h2 class="headline">{{ $player->nickname }} - {{ $player->team->name }}</h2>
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