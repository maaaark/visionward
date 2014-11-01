@extends('layouts.small_header')
@section('title', $champion->name)
@section('subtitle', $champion->title)
@section('content')

		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-6"><strong>Schaden</strong></div>
			<div class="col-md-3 col-sm-6 col-xs-6">{{ $champion->attackdamage }} (+ {{ $champion->attackdamageperlevel }} / Level)</div>
			<div class="col-md-3 col-sm-6 col-xs-6"><strong>Leben</strong></div>
			<div class="col-md-3 col-sm-6 col-xs-6">{{ $champion->hp }} (+ {{ $champion->hpperlevel }} / Level)</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-6"><strong>Reichweite</strong></div>
			<div class="col-md-3 col-sm-6 col-xs-6">{{ $champion->attackrange }}</div>
			<div class="col-md-3 col-sm-6 col-xs-6"><strong>Mana</strong></div>
			<div class="col-md-3 col-sm-6 col-xs-6">{{ $champion->mp }} (+ {{ $champion->mpperlevel }} / Level)</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-6"><strong>Rüstung</strong></div>
			<div class="col-md-3 col-sm-6 col-xs-6">{{ $champion->armor }} (+ {{ $champion->armorperlevel }} / Level)</div>
			<div class="col-md-3 col-sm-6 col-xs-6"><strong>Geschwindigkeit</strong></div>
			<div class="col-md-3 col-sm-6 col-xs-6">{{ $champion->movespeed }}</div>
		</div>
	<br/><br/>

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
				<td vlaign="top"><img src="http://ddragon.leagueoflegends.com/cdn/{{$patchversion->value}}/img/spell/{{ $skill->icon}}" class="img-circle" /></td>
				<td vlaign="top"><strong>{{ $skill->name }}</strong></br>{{ $skill->description }}</td>
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