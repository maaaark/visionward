@extends('layouts.no_sidebar')
@section('title', "Flashignite.com Team" )
@section('subtitle', "Die Personen hinter der Seite" )
@section('header_image',"pro_teams.jpg")
@section('content')

		@foreach($users as $user)
		<div class="col-md-3 team_member">
			<h2 class="headline">{{ $user->first_name }} {{ $user->last_name }}</h2>
			<div style="text-align: center;">
				<img src="/img/team/{{ $user->image }}" class="img-circle" width="150" height="150" /><br/><br/>
			</div>
			<strong>Summoner: </strong>{{ $user->username }}<br/>
			<strong>Aufgabe: </strong>{{ $user->task }}<br/>
			<br/>
			{{ $user->description }}
			<br/>
			<br/>
			<div class="center">
				<a href="mailto: {{ $user->email }}" target="blank"><img src="/img/twitter.png" alt="{{ $user->email }}" width="35" /></a>
			</div>
		</div>
		@endforeach

@stop