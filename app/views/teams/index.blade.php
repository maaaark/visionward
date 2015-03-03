@extends('layouts.no_sidebar')
@section('title', "Professionelle League of Legends Teams")
@section('subtitle', "Europa, Nordamerika, Korea, China und Taiwan")
@section('header_image',"pro_teams.jpg")
@section('content')
<table width="100%" class="team_overview" cellspacing="5" cellpadding="10">
	<tr>
		<td valign="top">
			<h2><img src="<?=Croppa::url('/img/teams/euLCS.png', 40, null)?>" height="40" /> <span class="hidden-xs hidden-sm">EU LCS</span></h2>
			<table class="table table-striped">
				<tr>
					<th>Rang</th>
					<th>Team</th>
					<th>Win</th>
					<th>Loss</th>
				</tr>
				@foreach($eu_standings as $standing)
				<tr>
					<td>{{ $standing->rank }}. 
					@if($standing->rank > $standing->last_rank)
						<span class="rang_down">&#x25BC; {{ $standing->rank-$standing->last_rank }}</span></td>
					@elseif($standing->rank < $standing->last_rank)
						<span class="rang_up">&#x25B2; {{ $standing->last_rank-$standing->rank }}</span>
					@else
						&nbsp;&nbsp;-
					@endif
					<td width="200"><a href="/teams/{{ $standing->team->id }}/{{ $standing->team->slug }}"><img class="" src="<?=Croppa::url('/img/teams/logos/'.$standing->team->logo, 18, null)?>" width="18" />&nbsp;&nbsp;<img class="hidden-xs hidden-sm" src="/img/flags/{{ $standing->team->country }}.png" />&nbsp;&nbsp;<span class="hidden-xs hidden-sm">{{ $standing->team->name }}</span></a></td>
					<td>{{ $standing->wins }}</td>
					<td>{{ $standing->loss }}</td>
				</tr>
				@endforeach
			</table>
		</td>
		<td width="20"></td>
		<td valign="top">
			<h2><img src="<?=Croppa::url('/img/teams/naLCS.png', 40, null)?>" height="40" /> <span class="hidden-xs hidden-sm">NA LCS</span></h2>
			<table class="table table-striped">
				<tr>
					<th>Rang</th>
					<th>Team</th>
					<th>Win</th>
					<th>Loss</th>
				</tr>
				@foreach($na_standings as $standing)
				<tr>
					<td>{{ $standing->rank }}. 
					@if($standing->rank > $standing->last_rank)
						<span class="rang_down">&#x25BC; {{ $standing->rank-$standing->last_rank }}</span></td>
					@elseif($standing->rank < $standing->last_rank)
						<span class="rang_up">&#x25B2; {{ $standing->last_rank-$standing->rank }}</span>
					@else
						&nbsp;&nbsp;-
					@endif
					<td width="200"><a href="/teams/{{ $standing->team->id }}/{{ $standing->team->slug }}"><img class="" src="<?=Croppa::url('/img/teams/logos/'.$standing->team->logo, 18, null)?>" width="18" />&nbsp;&nbsp;<img class="hidden-xs hidden-sm" src="/img/flags/{{ $standing->team->country }}.png" />&nbsp;&nbsp;<span class="hidden-xs hidden-sm">{{ $standing->team->name }}</span></a></td>
					<td>{{ $standing->wins }}</td>
					<td>{{ $standing->loss }}</td>
				</tr>
				@endforeach
			</table>
		</td>
		<td width="20"></td>
		<td valign="top">
			<h2><img src="/img/teams/challenger.png" height="40" /> <span class="hidden-xs hidden-sm">Challenger EU / NA</span></h2>
			<table class="table table-striped">
				<tr>
					<th>Rang</th>
					<th>Team</th>
					<th>Win</th>
					<th>Loss</th>
				</tr>
				@foreach($cs_eu_standings as $standing)
				<tr>
					<td>{{ $standing->rank }}. 
					@if($standing->rank > $standing->last_rank)
						<span class="rang_down">&#x25BC; {{ $standing->rank-$standing->last_rank }}</span></td>
					@elseif($standing->rank < $standing->last_rank)
						<span class="rang_up">&#x25B2; {{ $standing->last_rank-$standing->rank }}</span>
					@else
						&nbsp;&nbsp;-
					@endif
					<td width="200"><a href="/teams/{{ $standing->team->id }}/{{ $standing->team->slug }}"><img class="" src="<?=Croppa::url('/img/teams/logos/'.$standing->team->logo, 18, null)?>" width="18" />&nbsp;&nbsp;<img class="hidden-xs hidden-sm" src="/img/flags/{{ $standing->team->country }}.png" />&nbsp;&nbsp;<span class="hidden-xs hidden-sm">{{ $standing->team->name }}</span></a></td>
					<td>{{ $standing->wins }}</td>
					<td>{{ $standing->loss }}</td>
				</tr>
				@endforeach
			</table>
			<br/>
			<table class="table table-striped">
				@foreach($cs_na_standings as $standing)
				<tr>
					<td>{{ $standing->rank }}. 
					@if($standing->rank > $standing->last_rank)
						<span class="rang_down">&#x25BC; {{ $standing->rank-$standing->last_rank }}</span></td>
					@elseif($standing->rank < $standing->last_rank)
						<span class="rang_up">&#x25B2; {{ $standing->last_rank-$standing->rank }}</span>
					@else
						&nbsp;&nbsp;-
					@endif
					<td width="200"><a href="/teams/{{ $standing->team->id }}/{{ $standing->team->slug }}"><img class="" src="<?=Croppa::url('/img/teams/logos/'.$standing->team->logo, 18, null)?>" width="18" />&nbsp;&nbsp;<img class="hidden-xs hidden-sm" src="/img/flags/{{ $standing->team->country }}.png" />&nbsp;&nbsp;<span class="hidden-xs hidden-sm">{{ $standing->team->name }}</span></a></td>
					<td>{{ $standing->wins }}</td>
					<td>{{ $standing->loss }}</td>
				</tr>
				@endforeach
			</table>
		</td>
	</tr>
</table>	
<br/>
<table width="100%" class="team_overview">
	<tr>
		<td valign="top">
			<h2><img src="<?=Croppa::url('/img/teams/ogn.png', 40, null)?>" height="40" /> <span class="hidden-xs hidden-sm">LCK</span></h2>
			<table class="table table-striped">
				@foreach($ogn->teams as $team)
				<tr>
					<td><a href="/teams/{{ $team->id }}/{{ $team->slug }}"><img src="<?=Croppa::url('/img/teams/logos/'.$team->logo, 18, null)?>" width="18" />&nbsp;&nbsp;<img class="hidden-xs hidden-sm" src="/img/flags/{{ $team->country }}.png" />&nbsp;&nbsp;<span class="hidden-xs hidden-sm"><span class="hidden-xs hidden-sm">{{ $team->name }}</span></a></td>
				</tr>
				@endforeach
			</table>
		</td>
		<td valign="top">
			<h2><img src="<?=Croppa::url('/img/teams/gpl.png', 40, null)?>" height="40" /> <span class="hidden-xs hidden-sm">GPL</span></h2>
			<table class="table table-striped">
				@foreach($gpl->teams as $team)
				<tr>
					<td><a href="/teams/{{ $team->id }}/{{ $team->slug }}"><img src="<?=Croppa::url('/img/teams/logos/'.$team->logo, 18, null)?>" width="18" />&nbsp;&nbsp;<img class="hidden-xs hidden-sm" src="/img/flags/{{ $team->country }}.png" />&nbsp;&nbsp;<span class="hidden-xs hidden-sm">{{ $team->name }}</span></a></td>
				</tr>
				@endforeach
			</table>
		</td>
		<td valign="top">
			<h2><img src="<?=Croppa::url('/img/teams/lpl.png', 40, null)?>" height="40" /> <span class="hidden-xs hidden-sm">LPL</span></h2>
			<table class="table table-striped">
				@foreach($lpl->teams as $team)
				<tr>
					<td><a href="/teams/{{ $team->id }}/{{ $team->slug }}"><img src="<?=Croppa::url('/img/teams/logos/'.$team->logo, 18, null)?>" width="18" />&nbsp;&nbsp;<img class="hidden-xs hidden-sm" src="/img/flags/{{ $team->country }}.png" />&nbsp;&nbsp;<span class="hidden-xs hidden-sm">{{ $team->name }}</span></a></td>
				</tr>
				@endforeach
			</table>
		</td>
		<td valign="top">
			<h2><img src="<?=Croppa::url('/img/teams/lms.png', 40, null)?>" height="40" /> <span class="hidden-xs hidden-sm">LMS</span></h2>
			<table class="table table-striped">
				@foreach($lms->teams as $team)
				<tr>
					<td><a href="/teams/{{ $team->id }}/{{ $team->slug }}"><img src="<?=Croppa::url('/img/teams/logos/'.$team->logo, 18, null)?>" width="18" />&nbsp;&nbsp;<img class="hidden-xs hidden-sm" src="/img/flags/{{ $team->country }}.png" />&nbsp;&nbsp;<span class="hidden-xs hidden-sm">{{ $team->name }}</span></a></td>
				</tr>
				@endforeach
			</table>
		</td>
	</tr>
</table>
<br/>
	
@stop