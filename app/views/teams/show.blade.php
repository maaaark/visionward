@extends('layouts.master')
@section('title', $team->name)
@section('header_image',"pro_teams.jpg")
@section('content')
	
	<h3 class="headline">{{ $team->name }} Mitglieder</h3>
	<table width="100%">
		<tr>
			<td width="220" valign="top">
				<img src="/img/teams/logos/alliance.png" width="200" />
			</td>
			<td>
				<br/>
				<table class="table table-striped">
					<tr>
						<td width="150"><strong>Top-Lane</strong></td>
						<td>Wickd</td>
					</tr>
					<tr>
						<td><strong>Jungle</strong></td>
						<td>Shook</td>
					</tr>
					<tr>
						<td><strong>Mid-Lane</strong></td>
						<td>Froggen</td>
					</tr>
					<tr>
						<td><strong>AD-Carry</strong></td>
						<td>Tabzz</td>
					</tr>
					<tr>
						<td><strong>Support</strong></td>
						<td>Nyph</td>
					</tr>
				</table>
			</td>
		</tr>
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