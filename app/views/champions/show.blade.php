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
	<br/>
	<br/>
	@include("counterpicks.list")
	
@stop