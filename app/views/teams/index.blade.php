@extends('layouts.no_sidebar')
@section('title', "Professionelle League of Legends Teams")
@section('header_image',"pro_teams.jpg")
@section('content')
	
<table width="100%" class="team_overview">
	<tr>
		<td valign="top">
			<h2><img src="/img/teams/euLCS.png" height="40" /> EU LCS</h2>
			<table class="table table-striped">
				@foreach($eulcs->teams as $team)
				<tr>
					<td><img src="/img/teams/logos/{{ $team->logo }}" width="18" />&nbsp;&nbsp;<img src="/img/flags/{{ $team->country }}.png" />&nbsp;&nbsp;<a href="/teams/{{ $team->id }}/{{ $team->name }}">{{ $team->name }}</a></td>
				</tr>
				@endforeach
			</table>
		</td>
		<td valign="top">
			<h2><img src="/img/teams/naLCS.png" height="40" /> NA LCS</h2>
			<table class="table table-striped">
				@foreach($nalcs->teams as $team)
				<tr>
					<td><img src="/img/teams/logos/{{ $team->logo }}" width="18" />&nbsp;&nbsp;<img src="/img/flags/{{ $team->country }}.png" />&nbsp;&nbsp;<a href="/teams/{{ $team->id }}/{{ $team->name }}">{{ $team->name }}</a></td>
				</tr>
				@endforeach
			</table>
		</td>
		<td valign="top">
			<h2><img src="/img/teams/ogn.png" height="40" /> OGN</h2>
			<table class="table table-striped">
				@foreach($ogn->teams as $team)
				<tr>
					<td><img src="/img/teams/logos/{{ $team->logo }}" width="18" />&nbsp;&nbsp;<img src="/img/flags/{{ $team->country }}.png" />&nbsp;&nbsp;<a href="/teams/{{ $team->id }}/{{ $team->name }}">{{ $team->name }}</a></td>
				</tr>
				@endforeach
			</table>
		</td>
		<td valign="top">
			<h2><img src="/img/teams/gpl.png" height="40" /> GPL</h2>
			<table class="table table-striped">
				@foreach($gpl->teams as $team)
				<tr>
					<td><img src="/img/teams/logos/{{ $team->logo }}" width="18" />&nbsp;&nbsp;<img src="/img/flags/{{ $team->country }}.png" />&nbsp;&nbsp;<a href="/teams/{{ $team->id }}/{{ $team->name }}">{{ $team->name }}</a></td>
				</tr>
				@endforeach
			</table>
		</td>
		<td valign="top">
			<h2><img src="/img/teams/lpl.png" height="40" /> LPL</h2>
			<table class="table table-striped">
				@foreach($lpl->teams as $team)
				<tr>
					<td><img src="/img/teams/logos/{{ $team->logo }}" width="18" />&nbsp;&nbsp;<img src="/img/flags/{{ $team->country }}.png" />&nbsp;&nbsp;<a href="/teams/{{ $team->id }}/{{ $team->name }}">{{ $team->name }}</a></td>
				</tr>
				@endforeach
			</table>
		</td>
	</tr>
</table>
<br/>
	
@stop