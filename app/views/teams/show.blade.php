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
				
					
					<tr>
						<td width="120"><strong>Top-Lane</strong></td>
						@if($top)
						<td><img src="/img/flags/{{ $top->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $top->id }}/{{ $top->nickname }}">{{ $top->nickname }}</a></td>
						@else
						<td>Kein Spieler</td>
						@endif
					</tr>					
					<tr>
						<td width="120"><strong>Jungle</strong></td>
						@if($jungle)
						<td><img src="/img/flags/{{ $jungle->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $jungle->id }}/{{ $jungle->nickname }}">{{ $jungle->nickname }}</a></td>
						@else
						<td>Kein Spieler</td>
						@endif
					</tr>
					<tr>
						<td width="120"><strong>Mid-Lane</strong></td>
						@if($mid)
						<td><img src="/img/flags/{{ $mid->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $mid->id }}/{{ $mid->nickname }}">{{ $mid->nickname }}</a></td>
						@else
						<td>Kein Spieler</td>
						@endif
					</tr>
					<tr>
						<td width="120"><strong>AD-Carry</strong></td>
						@if($adc)
						<td><img src="/img/flags/{{ $adc->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $mid->id }}/{{ $mid->nickname }}">{{ $mid->nickname }}</a></td>
						@else
						<td>Kein Spieler</td>
						@endif
					</tr>
					<tr>
						<td width="120"><strong>Support</strong></td>
						@if($support)
						<td><img src="/img/flags/{{ $support->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $support->id }}/{{ $support->nickname }}">{{ $support->nickname }}</a></td>
						@else
						<td>Kein Spieler</td>
						@endif
					</tr>
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