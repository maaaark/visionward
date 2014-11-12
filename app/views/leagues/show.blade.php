@extends('layouts.small_header')
@section('title', $league->name)
@section('header_image',"pro_teams.jpg")
@section('content')
	
	<h2 class="headline">{{ $league->name }} Teams</h2>
	<table width="100%">
		<tr>
			<td width="220" valign="top">
				<img src="/img/leagues/{{ $league->logo }}" width="200" />
			</td>
			<td>
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
	<br/>
	
@stop