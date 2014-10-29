@extends('layouts.small_header')
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
				@include("teams.playerlist")
			</td>
		</tr>
	</table>
	<br/>
	<h2 class="headline_no_border">Teilnehmende Ligen</h2>
	<table class="table table-striped">
		@foreach($team->leagues as $league)
		<tr>
			<td><img src="/img/leagues/{{ $league->logo }}" height="20" />&nbsp;&nbsp;<a href="/leagues/{{ $league->id }}/{{ $league->slug }}">{{ $league->name }}</a></td>
		</tr>
		@endforeach
	</table>
	<br/>
	<h2 class="headline">{{ $team->name }} Beschreibung</h2>
	{{ $team->description }}<br/>
	<br/>
	<h2 class="headline_no_border">Platzierungen</h2>
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