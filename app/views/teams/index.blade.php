@extends('layouts.no_sidebar')
@section('title', "Professionelle League of Legends Teams")
@section('subtitle', "Europa, Nordamerika, Korea, China und Taiwan")
@section('header_image',"pro_teams.jpg")
@section('content')
			
<table width="100%" class="team_overview">
	<tr>
		<td valign="top">
			<h2><img src="/img/teams/euLCS.png" height="40" /> <span class="hidden-xs hidden-sm">EU LCS</span></h2>
			<table class="table table-striped">
				@foreach($eulcs->teams as $team)
				<tr>
					<td><a href="/teams/{{ $team->id }}/{{ $team->name }}"><img class="" src="/img/teams/logos/{{ $team->logo }}" width="18" />&nbsp;&nbsp;<img class="hidden-xs hidden-sm" src="/img/flags/{{ $team->country }}.png" />&nbsp;&nbsp;<span class="hidden-xs hidden-sm">{{ $team->name }}</span></a></td>
				</tr>
				@endforeach
			</table>
		</td>
		<td valign="top">
			<h2><img src="/img/teams/naLCS.png" height="40" /> <span class="hidden-xs hidden-sm">NA LCS</span></h2>
			<table class="table table-striped">
				@foreach($nalcs->teams as $team)
				<tr>
					<td><a href="/teams/{{ $team->id }}/{{ $team->name }}"><img src="/img/teams/logos/{{ $team->logo }}" width="18" />&nbsp;&nbsp;<img class="hidden-xs hidden-sm" src="/img/flags/{{ $team->country }}.png" />&nbsp;&nbsp;<span class="hidden-xs hidden-sm">{{ $team->name }}</span></a></td>
				</tr>
				@endforeach
			</table>
		</td>
		<td valign="top">
			<h2><img src="/img/teams/ogn.png" height="40" /> <span class="hidden-xs hidden-sm">OGN</span></h2>
			<table class="table table-striped">
				@foreach($ogn->teams as $team)
				<tr>
					<td><a href="/teams/{{ $team->id }}/{{ $team->name }}"><img src="/img/teams/logos/{{ $team->logo }}" width="18" />&nbsp;&nbsp;<img class="hidden-xs hidden-sm" src="/img/flags/{{ $team->country }}.png" />&nbsp;&nbsp;<span class="hidden-xs hidden-sm"><span class="hidden-xs hidden-sm">{{ $team->name }}</span></a></td>
				</tr>
				@endforeach
			</table>
		</td>
		<td valign="top">
			<h2><img src="/img/teams/gpl.png" height="40" /> <span class="hidden-xs hidden-sm">GPL</span></h2>
			<table class="table table-striped">
				@foreach($gpl->teams as $team)
				<tr>
					<td><a href="/teams/{{ $team->id }}/{{ $team->name }}"><img src="/img/teams/logos/{{ $team->logo }}" width="18" />&nbsp;&nbsp;<img class="hidden-xs hidden-sm" src="/img/flags/{{ $team->country }}.png" />&nbsp;&nbsp;<span class="hidden-xs hidden-sm">{{ $team->name }}</span></a></td>
				</tr>
				@endforeach
			</table>
		</td>
		<td valign="top">
			<h2><img src="/img/teams/lpl.png" height="40" /> <span class="hidden-xs hidden-sm">LPL</span></h2>
			<table class="table table-striped">
				@foreach($lpl->teams as $team)
				<tr>
					<td><a href="/teams/{{ $team->id }}/{{ $team->name }}"><img src="/img/teams/logos/{{ $team->logo }}" width="18" />&nbsp;&nbsp;<img class="hidden-xs hidden-sm" src="/img/flags/{{ $team->country }}.png" />&nbsp;&nbsp;<span class="hidden-xs hidden-sm">{{ $team->name }}</span></a></td>
				</tr>
				@endforeach
			</table>
		</td>
	</tr>
</table>
<br/>
	
@stop