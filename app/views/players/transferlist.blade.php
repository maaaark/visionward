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
						<td><a href="/players/{{ $transfer->player->id }}/{{ $transfer->player->nickname }}">{{ $transfer->player->first_name }} '{{ $transfer->player->nickname }}' {{ $transfer->player->last_name }}</a></td>
						<td class="old_team"><a href="/teams/{{ $transfer->oldteam->id }}/{{ $transfer->oldteam->name }}"><img src="/img/teams/logos/{{ $transfer->oldteam->logo }}" height="20" />&nbsp;&nbsp;{{ $transfer->oldteam->name }}</td>
						<td class="new_team"><a href="/teams/{{ $transfer->team->id }}/{{ $transfer->team->name }}"><img src="/img/teams/logos/{{ $transfer->team->logo }}" height="20" />&nbsp;&nbsp;{{ $transfer->team->name }}</a></td>
						<td>{{ $transfer->join_date }}</td>
					</tr>
					@endforeach
				</table>
			</td>
		</tr>
	</table>
<br/>
	
@stop