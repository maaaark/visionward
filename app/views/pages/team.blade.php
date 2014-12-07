@extends('layouts.no_sidebar')
@section('title', "Flashignite.com Team" )
@section('subtitle', "Die Personen hinter der Seite" )
@section('header_image',"pro_teams.jpg")
@section('content')

		@foreach($users as $user)
		<div class="col-md-3 team_member">
			<h2 class="headline">{{ $user->first_name }} {{ $user->last_name }}</h2>
			<div style="text-align: center;">
				<a href="/users/{{ $user->id }}"><img src="/img/team/{{ $user->image }}" class="img-circle" width="150" height="150" /></a><br/><br/>
			</div>
			<strong>Summoner: </strong><a href="/summoner/euw/{{ $user->username }}">{{ $user->username }}</a><br/>
			<strong>Aufgabe: </strong>{{ $user->task }}<br/>
			<br/>
			{{ $user->description }}
			<br/>
			<br/>
			<div class="center">
				<a href="mailto: {{ $user->email }}" target="blank"><img src="/img/email.png" alt="{{ $user->email }}" width="35" /></a>
				@if($user->twitter != "")
				<a href="http://twitter.com/{{ $user->twitter }}" target="blank"><img src="/img/twitter.png" alt="{{ $user->email }}" width="35" /></a>
				@endif
				@if($user->twitch != "")
				<a href="http://twitch.tv/{{ $user->twitch }}" target="blank"><img src="/img/twitch.png" alt="{{ $user->email }}" width="35" /></a>
				@endif
			</div>
		</div>
		@endforeach

@stop