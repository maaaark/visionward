@extends('layouts.small_header')
@section('title', "Suchergebnis" )
@section('subtitle', "" )
@section('header_image',"pro_teams.jpg")
@section('content')
	<?php
	
		//die("qwe");
		//var_dump($news); die("qwer");
	
	?>
	<div style="margin-bottom: 40px;">
		<div><strong>Suchergebnisse für News</strong></div>
		<div style="margin-bottom: 15px;"><small>Es wurden {{ count($news) }} Ergebnisse gefunden.</small></div>
		@foreach ($news as $singleNews)
			<?php //var_dump($singleNews); ?>
			<div style="margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #333;">
				<div><strong><a href="/news/{{$singleNews->id}}/{{$singleNews->slug}}">{{$singleNews->title}}</a></strong></div>
				<div><small>{{$singleNews->slug}}</small></div>
			</div>
		@endforeach
	</div>
	<div style="margin-bottom: 40px;">
		<div><strong>Suchergebnisse für Champions</strong></div>
		<div style="margin-bottom: 15px;"><small>Es wurden {{ count($champs) }} Champions gefunden.</small></div>
		@foreach ($champs as $singleChamp)
			<?php //var_dump($singleChamp);die("qwe"); ?>
			<div style="margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #333;">
				<div><a href="/champions/{{ $singleChamp->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $singleChamp->key }}.png" class="img-circle" width="30" /></a><strong><a href="/champions/{{$singleChamp->key}}">{{$singleChamp->name}}</a></strong></div>
				<div><small>{{$singleChamp->title}}</small></div>
			</div>
		@endforeach
	</div>
	<div style="margin-bottom: 40px;">
		<div><strong>Suchergebnisse für Spieler</strong></div>
		<div style="margin-bottom: 15px;"><small>Es wurden {{ count($players) }} Spieler gefunden.</small></div>
		@foreach ($players as $singlePlayer)
			<?php //var_dump($singlePlayer);die("qwe"); ?>
			<div style="margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #333;">
				<div><img src="/img/players/{{$singlePlayer->picture}}" width="32"><strong><a href="/players/{{$singlePlayer->id}}/{{$singlePlayer->nickname}}">{{$singlePlayer->first_name}} "{{$singlePlayer->nickname}}" {{$singlePlayer->last_name}}</a></strong></div>
			</div>
		@endforeach
	</div>
	<div>
		<div><strong>Suchergebnisse für Teams</strong></div>
		<div style="margin-bottom: 15px;"><small>Es wurden {{ count($teams) }} Teams gefunden.</small></div>
		@foreach ($teams as $singleTeam)
			<?php //var_dump($singleTeam);die("qwe"); ?>
			<div style="margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #333;">
				<div><img src="/img/teams/logos/{{$singleTeam->logo}}" height="32"><strong><a href="/teams/{{$singleTeam->id}}/{{$singleTeam->name}}">{{$singleTeam->name}}</a></strong></div>
			</div>
		@endforeach
	</div>
@stop