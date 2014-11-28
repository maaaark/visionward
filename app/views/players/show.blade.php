@extends('layouts.small_header')
@section('title', $player->nickname)
@section('subtitle', $player->team->name)
@section('header_image',"pro_teams.jpg")
@section('content')

	<table width="100%">
		<tr>
			<td width="220" valign="top">
				<img src="/img/players/{{ $player->picture }}" class="img-circle" width="200" />
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
						<td><a href="/teams/{{ $player->team->id }}/{{ $player->team->slug }}">{{ $player->team->name }}</td>
					</tr>
					<tr>
						<td><strong>Geboren in</strong></td>
						<td><img src="/img/flags/{{ $player->country }}.png" /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br/>
	@if($player->description != "")
	<h2 class="headline">{{ $player->name }} Beschreibung</h2>
	{{ $player->description }}<br/>
	<br/>
	@endif
		<h2 class="headline_no_border">Vorherige Teams</h2>
		<table class="table table-striped">
			<tr>
				<th>Vorheriges Team</th>
				<th>Neues Team</th>
				<th>Wechseldatum</th>
			</tr>
			@foreach($player->history as $history)
			<tr>
				<td width="250" class="old_team"><a href="/teams/{{ $history->oldteam->id }}/{{ $history->oldteam->slug }}"><img src="/img/teams/logos/{{ $history->oldteam->logo }}" height="20" />&nbsp;&nbsp;{{ $history->oldteam->name }}</a></td>
				<td width="250" class="new_team"><a href="/teams/{{ $history->team->id }}/{{ $history->team->slug }}"><img src="/img/teams/logos/{{ $history->team->logo }}" height="20" />&nbsp;&nbsp;{{ $history->team->name }}</a></td>
				<td>{{ $history->join_date }}</td>
			</tr>
			@endforeach
		</table>
	<br/>
	
<h2 class="headline">Kommenare zu {{ $player->nickname }}</h2>
@include("layouts.disqus")
@stop