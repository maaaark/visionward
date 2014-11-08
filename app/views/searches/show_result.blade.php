@extends('layouts.small_header')
@section('title', "Suchergebnis" )
@section('subtitle', "" )
@section('header_image',"pro_teams.jpg")
@section('content')
	
	@if($summoner != "")
	<div style="margin-bottom: 40px;">
		<div><strong>Suchergebnisse für Summoner</strong></div>
		<div class="summoner_search">
			<table>
				<tr>
					<td width="65"><a href="/summoner/{{ $summoner->region }}/{{ $summoner->name }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/profileicon/{{ $summoner->profileIconId }}.png" class="img-circle" width="50"></a></td>
					<td valign="top">
						<a href="/summoner/{{ $summoner->region }}/{{ $summoner->name }}"><strong>{{ $summoner->name }}</strong></a><br/>
						<a href="/summoner/{{ $summoner->region }}/{{ $summoner->name }}">Level {{ $summoner->summonerLevel }} - {{ $summoner->region }}</a>
					</td>
				</tr>
			</table>
			
		</div>
		
	</div>
	@endif
	
	<div style="margin-bottom: 40px;">
		<div><strong>Suchergebnisse für News</strong></div>
		<div style="margin-bottom: 15px;"><small>Es wurden {{ count($news) }} Ergebnisse gefunden.</small></div>
		<table class="table table-striped">
		@foreach ($news as $singleNews)
			<tr>
				<td width="55"><img  src="<?=Croppa::url('/uploads/news/'.$singleNews->image, 50, null)?>"  width="50"/></td>
				<td><div><strong><a href="/news/{{$singleNews->id}}/{{$singleNews->slug}}">{{$singleNews->title}}</a></strong></div>
				<div><small>{{$singleNews->excerpt}}</small></div></td>
			</tr>
		@endforeach
		</table>
	</div>
	<div style="margin-bottom: 40px;">
		<div><strong>Suchergebnisse für Champions</strong></div>
		<div style="margin-bottom: 15px;"><small>Es wurden {{ count($champs) }} Champions gefunden.</small></div>
		<table class="table table-striped">
		@foreach ($champs as $singleChamp)
			<?php //var_dump($singleChamp);die("qwe"); ?>
			<tr>
				<td width="55"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $singleChamp->key }}.png" class="img-circle" width="45" /></td>
				<td><div><strong><a href="/champions/{{$singleChamp->key}}">{{$singleChamp->name}}</a></strong></div>
				<div><small>{{$singleChamp->title}}</small></div></td>
			</tr>
		@endforeach
		</table>
	</div>
	<div style="margin-bottom: 40px;">
		<div><strong>Suchergebnisse für Spieler</strong></div>
		<div style="margin-bottom: 15px;"><small>Es wurden {{ count($players) }} Spieler gefunden.</small></div>
		<table class="table table-striped">
		@foreach ($players as $singlePlayer)
			<?php //var_dump($singlePlayer);die("qwe"); ?>
			<tr>
				<td width="55"><img src="<?=Croppa::url('/img/players/'.$singlePlayer->picture, 45, 45)?>" class="img-circle" /></td>
				<td><div><strong><a href="/champions/{{$singleChamp->key}}">{{$singlePlayer->nickname}}</a></strong></div>
				<div><small>{{$singlePlayer->first_name}} {{$singlePlayer->last_name}}</small></div></td>
			</tr>
			
		@endforeach
		</table>
	</div>
	<div>
		<div><strong>Suchergebnisse für Teams</strong></div>
		<div style="margin-bottom: 15px;"><small>Es wurden {{ count($teams) }} Teams gefunden.</small></div>
		<table class="table table-striped">
		@foreach ($teams as $singleTeam)
			<?php //var_dump($singleTeam);die("qwe"); ?>
			<tr>
				<td width="55"><img src="<?=Croppa::url('/img/teams/logos/'.$singleTeam->logo, 45, null)?>" height="45"></td>
				<td style="vertical-align: middle;"><strong><a href="/teams/{{$singleTeam->id}}/{{$singleTeam->name}}">{{$singleTeam->name}}</a></strong></td>
			</tr>
		@endforeach
		</table>
	</div>
@stop