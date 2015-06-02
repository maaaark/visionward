@extends('layouts.small_header')
@section('title', "Suchergebnis" )
@section('subtitle', "" )
@section('header_image',"pro_teams.jpg")
@section('content')
	
	@if($summoner)
	<div style="margin-bottom: 40px;">
		<div><strong>Suchergebnisse für Summoner</strong></div>
		<div class="summoner_search">
			<table>
				<tr>
					<td width="65"><a href="http://summoner.{{ MAIN_URL }}/{{ $summoner->region }}/{{ $summoner->name }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/profileicon/{{ $summoner->profileIconId }}.png" class="img-circle" width="50"></a></td>
					<td valign="top">
						<a href="http://summoner.{{ MAIN_URL }}/{{ $summoner->region }}/{{ $summoner->name }}"><strong>{{ $summoner->name }}</strong></a><br/>
						<a href="http://summoner.{{ MAIN_URL }}/{{ $summoner->region }}/{{ $summoner->name }}">Level {{ $summoner->summonerLevel }} - {{ $summoner->region }}</a>
					</td>
					<td width="50px"></td>
					@if($summoner->solo_tier == 'none')
						<td><img src="/img/ranked/unknown.png" width="50" class="img-circle" /></td>
					@else
					<td>
						@if($summoner->solo_tier != 'none')<img src="/img/ranked/{{$summoner->solo_tier}}_{{$summoner->solo_division}}.png" width="50" class="img-circle" />  {{$summoner->solo_tier}} {{$summoner->solo_division}}@endif
					</td>
					@endif
					@if($summoner->ranked_wins != 0 && $summoner->ranked_losses != 0 && $summoner->ranked_losses != 0)
					
					
						<td width="50px"></td>
					<td>
						Gewertete Spiele: </br>{{ $summoner->ranked_wins+$summoner->ranked_losses}}
						
							@if($summoner->ranked_wins/($summoner->ranked_wins+$summoner->ranked_losses)*100>=50)
								(<font style="color:#63A055">{{round($summoner->ranked_wins/($summoner->ranked_wins+$summoner->ranked_losses)*100,2)}}%</font> Siegesrate)
							@else
								(<font style="color:#DB2D2D">{{round($summoner->ranked_wins/($summoner->ranked_wins+$summoner->ranked_losses)*100,2)}}%</font> Siegesrate)
							@endif
						</td>
					</td>
						<td width="50px"></td>
					<td>
						Normale Siege: {{ $summoner->unranked_wins}}
					</td>
					@endif
				</tr>
			</table>
			
		</div>
		
	</div>
	@endif
	
	<div style="margin-bottom: 40px;">
		<div><strong>Suchergebnisse für News</strong></div>
		@if (count($news) === 1)
			<div style="margin-bottom: 15px;"><small>Es wurde {{ count($news) }} News gefunden.</small></div>
		@else
			<div style="margin-bottom: 15px;"><small>Es wurden {{ count($news) }} News gefunden.</small></div>
		@endif
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
		@if (count($champs) === 1)
			<div style="margin-bottom: 15px;"><small>Es wurde {{ count($champs) }} Champion gefunden.</small></div>
		@else
			<div style="margin-bottom: 15px;"><small>Es wurden {{ count($champs) }} Champions gefunden.</small></div>
		@endif
		<table class="table table-striped">
		<?php //var_dump(count($champs));die("Qwe");?>
		@foreach ($champs as $singleChamp)
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
		@if (count($players) === 1)
			<div style="margin-bottom: 15px;"><small>Es wurde {{ count($players) }} Spieler gefunden.</small></div>
		@else
			<div style="margin-bottom: 15px;"><small>Es wurden {{ count($players) }} Spieler gefunden.</small></div>
		@endif
		<table class="table table-striped">
		@foreach ($players as $singlePlayer)
			<tr>
				<td width="55"><img src="<?=Croppa::url('/img/players/'.$singlePlayer->picture, 45, 45)?>" class="img-circle" /></td>
				<td><div><strong><a href="/players/{{$singlePlayer->id}}/{{$singlePlayer->nickname}}">{{$singlePlayer->nickname}}</a></strong></div>
				<div><small>{{$singlePlayer->first_name}} {{$singlePlayer->last_name}}</small></div></td>
			</tr>
			
		@endforeach
		</table>
	</div>
	<div>
		<div><strong>Suchergebnisse für Teams</strong></div>
		@if (count($teams) === 1)
			<div style="margin-bottom: 15px;"><small>Es wurde {{ count($teams) }} Team gefunden.</small></div>
		@else
			<div style="margin-bottom: 15px;"><small>Es wurden {{ count($teams) }} Teams gefunden.</small></div>
		@endif
		
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