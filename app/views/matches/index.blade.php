@extends('layouts.small_header')
@section('title', "Die nächsten Profi Spiele")
@section('subtitle', "Professionelle League of Legends Spiele in der Übersicht")
@section('header_image',"pro_teams.jpg")
@section('content')

<h2 class="headline_no_border">Letzte Matches</h2>
	
<table width="100%" class="table table-striped">
	@foreach($matches as $match)
	<tr>
		<td width="180">
			<a href="/teams/{{ $match->team->id }}/{{ $match->team->name }}"><img src="/img/teams/logos/{{ $match->team->logo }}" height="20" /> {{ $match->team->name }}</a>
		</td>
		<td width="30">
			vs.
		</td>
		<td width="180">
			<a href="/teams/{{ $match->team2->id }}/{{ $match->team2->name }}"><img src="/img/teams/logos/{{ $match->team2->logo }}" height="20" /> {{ $match->team2->name }}</a>
		</td>
		<td width="180">
			<a href="/leagues/{{ $match->league->id }}/{{ $match->league->slug }}"><img src="/img/leagues/{{ $match->league->logo }}" height="20" /> {{ $match->league->name }}</a>
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