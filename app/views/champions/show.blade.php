@extends('layouts.small_header')
@section('title', $champion->name)
@section('subtitle', $champion->title)
@section('content')
	
	<table width="100%">
		<tr>
			<td width="120" valign="top"><a href="/counterpicks/{{ $champion->champion_id }}/{{ $champion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $champion->key }}.png" class="img-circle" width="100" /></a></td>
			<td>
				<table class="table table-striped">
					<tr>
						<td><strong>Schaden</strong></td>
						<td>{{ round($champion->attackdamage) }} (+ {{ round($champion->attackdamageperlevel) }} / Level)</td>
						<td><strong>Leben</strong></td>
						<td>{{ round($champion->hp) }} (+ {{ round($champion->hpperlevel) }} / Level)</td>
					</tr>
					<tr>
						<td><strong>Reichweite</strong></td>
						<td>{{ round($champion->attackrange) }}</td>
						<td><strong>Mana</strong></td>
						<td>{{ round($champion->mp) }} (+ {{ round($champion->mpperlevel) }} / Level)</td>
					</tr>
					<tr>
						<td><strong>Rüstung</strong></td>
						<td>{{ round($champion->armor) }} (+ {{ round($champion->armorperlevel) }} / Level)</td>
						<td><strong>Geschwindigkeit</strong></td>
						<td>{{ round($champion->movespeed) }}</td>
					</tr>
					<tr>
						<td><strong>Magic Res</strong></td>
						<td>{{ round($champion->spellblock) }} (+ {{ round($champion->spellblockperlevel) }} / Level)</td>
						<td><strong>Attackspeed</strong></td>
						<?php 
							$attackspeed = round(1 / (1.6 * (1 + $champion->attackspeedoffset )),3);
							$attackspeedPerLevel = round($champion->attackspeedperlevel);
						?>
						<td>{{ $attackspeed }} (+ {{ $attackspeedPerLevel }} %)</td>
					</tr>
					<tr>
						<td><strong>Lifereg</strong></td>
						<td>{{ round($champion->hpregen,1) }} (+ {{ round($champion->armorperlevel,1) }} / Level)</td>
						<td><strong>Manareg</strong></td>
						<td>{{ round($champion->mpregen,1) }} (+ {{ round($champion->hpregenperlevel,1) }} / Level)</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
	
	<br/>

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist" id="champion_tabs">
	  <li class="active"><a href="#skills" role="tab" data-toggle="tab">Fähigkeiten</a></li>
	  <li><a href="#counter" role="tab" data-toggle="tab">Konter</a></li>
	   <li><a href="#skins" role="tab" data-toggle="tab">Skins</a></li>
	  <li><a href="#tipps" role="tab" data-toggle="tab">Tipps</a></li>
	  <li><a href="#lore" role="tab" data-toggle="tab">Geschichte</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
	  <div class="tab-pane active" id="skills">
		<br/>
		<h2 class="headline_no_border">Fähigkeiten von {{ $champion->name }}</h2>
		<table class="table table-striped">
			@foreach($skills as $skill)
			<tr>
				<td vlaign="top">
				@if($skill->passive == 1)
					<a href="/skills/{{ $skill->id }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{$patchversion}}/img/passive/{{ $skill->icon}}" class="img-circle" /></a>
				@else
					<a href="/skills/{{ $skill->id }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{$patchversion}}/img/spell/{{ $skill->icon}}" class="img-circle" /></a>
				@endif</td>
				<td vlaign="top"><strong><a href="/skills/{{ $skill->id }}">{{ $skill->name }}@if($skill->passive == 1) (Passiv)@endif</a></strong></br>{{ $skill->description }}</td>
			</tr>
			@endforeach
		</table>
	  </div>
	  <div class="tab-pane" id="counter">
	  <br/>
		@include("counterpicks.list")</div>
	  <div class="tab-pane" id="skins">
		<br/>
		<h2 class="headline_no_border">{{ $champion->name }} Skins</h2>
		<table class="table table-striped">
		@foreach($skins as $skin)
			<tr>
				<td width="200">
					@if($skin->name == "default")
						<strong>Standard Skin</strong>
					@else
						<strong>{{ $skin->name }}</strong>
					@endif
				</td>
				<td>
					<img src="http://ddragon.leagueoflegends.com/cdn/img/champion/splash/{{ $champion->key }}_{{ $skin->skin_id}}.jpg" width="100%"/>
				</td>
			</tr>
		@endforeach
		</table>
	  </div>
	  <div class="tab-pane" id="tipps"><br/>@include("counterpicks.tips")</div>
	  <div class="tab-pane" id="lore">
		<br/>
		  <h2 class="headline">Die Geschichte von {{ $champion->name }}</h2>
		{{ $champion->lore }}
	  </div>
	</div>
	<br/><br/>
	@include("layouts.disqus")
	
@stop