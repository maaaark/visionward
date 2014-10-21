@extends('layouts.small_header')
@section('title', $champion->name)
@section('subtitle', $champion->title)
@section('content')
	<table class="table table-striped champion_stats">
		<tr>
			<td rowspan="3"><img src="http://ddragon.leagueoflegends.com/cdn/4.17.1/img/champion/{{ $champion->key }}.png" class="img-circle" /></td>
			<td width="120"><strong>Schaden</strong></td>
			<td>{{ $champion->attackdamage }} (+ {{ $champion->attackdamageperlevel }} / Level)</td>
			<td width="120"><strong>Leben</strong></td>
			<td>{{ $champion->hp }} (+ {{ $champion->hpperlevel }} / Level)</td>
		</tr>
		<tr>
			<td><strong>Reichweite</strong></td>
			<td>{{ $champion->attackrange }}</td>
			<td><strong>Mana</strong></td>
			<td>{{ $champion->mp }} (+ {{ $champion->mpperlevel }} / Level)</td>
		</tr>
		<tr>
			<td><strong>Rüstung</strong></td>
			<td>{{ $champion->armor }} (+ {{ $champion->armorperlevel }} / Level)</td>
			<td><strong>Geschwindigkeit</strong></td>
			<td>{{ $champion->movespeed }}</td>
		</tr>
	</table>
	Tipps:	<br/>
	
	als {{$champion->name}}	<br/>
	@if($champion->allytips1)1. {{$champion->allytips1}}	<br/>	<br/>@endif
	@if($champion->allytips2)2. {{$champion->allytips2}}	<br/>	<br/>@endif
	@if($champion->allytips3)3. {{$champion->allytips3}}	<br/>	<br/>@endif
	<br/>
	gegen {{$champion->name}}	<br/>
	@if($champion->enemytips1)1. {{$champion->enemytips1}}	<br/>	<br/>@endif
	@if($champion->enemytips2)2. {{$champion->enemytips2}}	<br/>	<br/>@endif
	@if($champion->enemytips3)3. {{$champion->enemytips3}}	<br/>	<br/>@endif
	<br/>
	<br/>
	@include("counterpicks.list")
		<br/>
	<br/>
	Geschichte:	{{ $champion->lore }}
	
@stop