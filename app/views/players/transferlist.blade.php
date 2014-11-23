@extends('layouts.small_header')
@section('title', "Spieler Transfers" )
@section('subtitle', "Alle League of Legends Spielertransfers in der Übersicht" )
@section('header_image',"pro_teams.jpg")
@section('content')
	
	<table width="100%">
		<tr>
			<td>
				<table class="table table-striped">
					<tr>
						<th>Spieler</th>
						<th>Vorheriges Team</th>
						<th>Neues Teams</th>
						<th>Bekanntgabe</th>
					</tr>
					@foreach($transfers as $transfer)
					<tr>
						<td width="120"><a href="/players/{{ $transfer->player->id }}/{{ $transfer->player->nickname }}" class="player_tooltip" rel="{{ $transfer->player->id }}">{{ $transfer->player->nickname }}</a></td>
						<td width="250" class="old_team"><a href="/teams/{{ $transfer->oldteam->id }}/{{ $transfer->oldteam->slug }}"><img src="/img/teams/logos/{{ $transfer->oldteam->logo }}" height="20" />&nbsp;&nbsp;{{ $transfer->oldteam->name }}</a> ({{ $transfer->old_role }})</td>
						<td width="250" class="new_team"><a href="/teams/{{ $transfer->team->id }}/{{ $transfer->team->slug }}"><img src="/img/teams/logos/{{ $transfer->team->logo }}" height="20" />&nbsp;&nbsp;{{ $transfer->team->name }}</a> ({{ $transfer->player->role }})</td>
						<td>{{ Helpers::diffForHumans($transfer->created_at) }}</td>
					</tr>
					@endforeach
				</table>
			</td>
		</tr>
	</table>
<br/>
	
@stop