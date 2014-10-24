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
	<table>
		@foreach($skills as $skill)
		<tr>
			<td><img src="http://ddragon.leagueoflegends.com/cdn/{{$patchversion->value}}/img/spell/{{ $skill->icon}}"/></td>
			<td><strong>{{ $skill->name }}</strong></br>{{ $skill->description }}</td>
		</tr>
		@endforeach
	</table>
	
	<table>
		<tr>
		@foreach($skins as $skin)
			<td><img src="http://ddragon.leagueoflegends.com/cdn/img/champion/loading/{{ $champion->key }}_{{ $skin->skin_id}}.jpg" width="100px"/></td>
		@endforeach
		</tr>
		<tr>
		@foreach($skins as $skin)
			<td><strong>{{ $skin->name }}</strong></td>
		@endforeach
		</tr>
	</table>
	
	
	<br/>

	@include("counterpicks.list")
	<br/>
	<br/>	<br/>
	@include("counterpicks.tips")
	<br/>	<br/>
	<h2 class="headline">Die Geschichte von {{ $champion->name }}</h2>
	{{ $champion->lore }}
	
@stop