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
				@include("teams.playerlist")
			</td>
		</tr>
	</table>
	<br/>
	<h2 class="headline_no_border">Teilnehmende Ligen</h2>
	<table class="table table-striped">
		@foreach($team->leagues as $league)
		<tr>
			<td><img src="/img/teams/{{ $league->logo }}" height="20" />&nbsp;&nbsp;<a href="/leagues/{{ $league->id }}/{{ $league->slug }}">{{ $league->name }}</a></td>
		</tr>
		@endforeach
	</table>
	<br/>
    @if($team->description != "")
	<h2 class="headline">{{ $team->name }} Beschreibung</h2>
	{{ $team->description }}<br/>
	<br/>
    @endif
	<h2 class="headline_no_border">Platzierungen</h2>
	<table class="table table-striped">
        @foreach($placements as $placement)
		<tr>
			<td width="75"><strong>Platz {{ $placement->place }}</strong></td>
			<td width="25"><a href="/leagues/{{ $placement->league->id }}/{{ $placement->league->slug }}"><img src="/img/teams/{{ $placement->league->logo }}" height="20" /></a></td>
			<td><a href="/leagues/{{ $placement->league->id }}/{{ $placement->league->slug }}">{{ $placement->league->name }}</a></td>
		</tr>
        @endforeach
	</table>
	<br/>
	<h2 class="headline">Kommentare zu {{ $team->name }}</h2>
	@include("layouts.disqus")

	
@stop