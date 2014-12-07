@extends('layouts.small_header')
@section('title', $league->name)
@section('header_image',"pro_teams.jpg")
@section('content')
	
	<h2 class="headline">{{ $league->name }} Teams</h2>
	<table width="100%">
		<tr>
			<td width="220" valign="top">
				<img src="/img/teams/{{ $league->logo }}" width="200" />
			</td>
			<td valign="top">
				<br/>
				<table class="table table-striped">
					@foreach($league->teams as $team)
					<tr>
						<td><img src="/img/flags/{{ $team->country }}.png" />&nbsp;&nbsp;<a href="/teams/{{ $team->id }}/{{ $team->name }}">{{ $team->name }}</a></td>
					</tr>
					@endforeach
				</table>
			</td>
		</tr>
	</table>
	<h3 class="headline">{{ $league->name }} Beschreibung</h3>
	{{ $league->description }}<br/>
	<br/><br/>
	<h2 class="headline_no_border">{{ $league->name }} Spiele</h2>
	<table class="table table-striped">
	@foreach($league->matches as $match)
		<tr>
		<td width="180">
			<a href="/teams/{{ $match->team->id }}/{{ $match->team->slug }}"><img src="/img/teams/logos/{{ $match->team->logo }}" height="20" /><span class="hidden-xs hidden-sm"> {{ $match->team->name }}</span></a>
		</td>
		<td width="30">
			vs.
		</td>
		<td width="180">
			<a href="/teams/{{ $match->team2->id }}/{{ $match->team2->slug }}"><img src="/img/teams/logos/{{ $match->team2->logo }}" height="20" /><span class="hidden-xs hidden-sm"> {{ $match->team2->name }}</span></a>
		</td>
		<td width="180">
			<a href="/leagues/{{ $match->league->id }}/{{ $match->league->slug }}"><img src="/img/teams/{{ $match->league->logo }}" height="20" /><span class="hidden-xs hidden-sm"> {{ str_limit($match->league->name, $limit = 15, $end = '...') }}</span></a>
		</td>
		<td>
			@if($match->game_date >= date('Y-m-d H:i:s'))
				<a href="/matches/{{ $match->id }}">{{ date("d.m - H:i",strtotime($match->game_date)) }} Uhr</a>
			@else
				@if($match->winner_team_id == 0)
					<a href="/matches/{{ $match->id }}">Live</a>
				@else
					<a href="/matches/{{ $match->id }}">Matchdetails ansehen</a>
				@endif
			@endif
		</td>
	</tr>
		@endforeach
	</table>
	<br/>
	
@stop