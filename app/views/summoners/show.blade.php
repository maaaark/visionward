@extends('layouts.small_header')
@section('title', $summoner->name)
@section('subtitle', $summoner->region)
@section('header_image',"summoner_header.jpg")
@section('content')


	<table width="100%" class="profile">
		<tr>
			<td valign="top" width="130" style="text-align: center; padding-right: 15px;">
				<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/profileicon/{{ $summoner->profileIconId }}.png" width="100" class="img-circle" /> {{$summoner->name}}<br/>
			</td>
			<td width="400" valign="top">
				<table class="table table-striped" stlye="width: 100%;">
					<tr>
						<td width="130" class="attribute">Normale Siege:</td>
						<td width="130" class="attribute">{{ $summoner->unranked_wins}}</td>
					</tr>
					<tr>
						<td width="130" class="attribute">Gewertete Spiele 4. Saison</td>
						<td width="130" class="attribute">{{ $summoner->ranked_wins+$summoner->ranked_losses}}</td>
					</tr>
					<tr>
						<td width="130" class="attribute">Gewertete</br> Siege / Niederlagen</td>
						<td width="130" class="attribute"></br>
						@if($summoner->ranked_wins != 0 && $summoner->ranked_losses != 0 && $summoner->ranked_losses != 0)
						{{ $summoner->ranked_wins}} / {{ $summoner->ranked_losses}} 
						@if($summoner->ranked_wins/($summoner->ranked_wins+$summoner->ranked_losses)*100>=50)
							(<font style="color:#63A055">{{round($summoner->ranked_wins/($summoner->ranked_wins+$summoner->ranked_losses)*100,2)}}%</font> Siegesrate)</td>
						@else
							(<font style="color:#DB2D2D">{{round($summoner->ranked_wins/($summoner->ranked_wins+$summoner->ranked_losses)*100,2)}}%</font> Siegesrate)</td>
						@endif
						@endif
						</tr>
				</table>
			</td>
			<td valign="top">
				<div class="profile_season_stats">
					<table class="table table-striped" style="margin-bottom: 0;text-align: center">
						<tr>
							<td colspan="3"><img src="/img/ranked/{{$summoner->solo_tier}}_{{$summoner->solo_division}}.png" width="100" class="img-circle" /></br>{{$summoner->solo_tier}} {{$summoner->solo_division}}</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
</br></br>
<h3>Letzten Spiele</h3></br>
		<table class="table">
			@foreach($summoner->games as $game)
				<?php 
					if($game["win"]==true) {
						$class = "success";
					} else {
						$class = "danger";
					}
				?>
				<tr class="<?php echo $class; ?>">
					<td>
						<a href="/counterpicks/{{ $game->champion->champion_id }}/{{ $game->champion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $game->champion->key }}.png" class="img-circle" width="35" /></a>
					</td>
					<td class="game_kda">
					{{ $game->championsKilled }} / {{ $game->numDeaths }} / {{ $game->assists }}<br/>
					@if($game->numDeaths > 0)
					KDA: {{ round(($game->championsKilled+$game->assists)/$game->numDeaths,2) }}
					@else
					KDA: {{ ($game->championsKilled+$game->assists) }}
					@endif
					</td>
					<td class="game_kda">
						{{ $game->subType }}<br/>
						{{ $game->minionsKilled }} CS ( {{ $game->neutralMinionsKilled }} neutral )
					</td>
					<td>
						<img src="/img/spells/{{ $game->spell1 }}.png" width="35" class="img-circle" > 
						<img src="/img/spells/{{ $game->spell2 }}.png" width="35" class="img-circle" >
					</td>
					<td id="items">
						@foreach($game->items as $item)
							<a href="/items/{{ $item->id }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/item/{{ $item->id }}.png" data-toggle="tooltip" data-placement="top" title="{{ $item->name }}" width="35" class="img-circle items" ></a>
						@endforeach	
					</td>

					
				</tr>
				<tr class="game_detail_toggle game_details-{{ $game->id }}" >
					<td colspan="6" class="game_details">
						<table class="table">
							@if($game->incomplete == true)
							<tr>
								<td colspan="6"><span class="incomplete">This Match Data is incomplete! The Riot API doesn't provide all informations for this game.</span></td>
							</tr>
							@endif
							<tr>
								<td><strong>Gold earned</strong></td>
								<td>{{ $game->goldEarned }}</td>
								<td><strong>Wards placed</strong></td>
								<td>{{ $game->wardPlaced }}</td>
								<td><strong>Wards destroyed</strong></td>
								<td>{{ $game->wardKilled }}</td>
							</tr>
							<tr>
								<td><strong>Total damage Taken</strong></td>
								<td>{{ $game->totalDamageTaken }}</td>
								<td><strong>Total damage Dealt</strong></td>
								<td>{{ $game->totalDamageDealt }}</td>
								<td><strong>Total Heal</strong></td>
								<td>{{ $game->totalHeal }}</td>
							</tr>
							<tr>
								<td><strong>Game lenght</strong></td>
								<td>{{ gmdate("i", $game->timePlayed) }} min</td>
								<td><strong>Team</strong></td>
								<td>
									@if($game->teamId == 100)
										Blue
									@else
										Purple
									@endif
								</td>
								<td><strong>Turrets destroyed</strong></td>
								<td>{{ $game->turretsKilled }}</td>
							</tr>
							<tr>
								<td><strong>Killingsprees</strong></td>
								<td>{{ $game->killingSprees }}</td>
								<td><strong>Game Date</strong></td>
								<td>{{ date("d.m.Y H:i", $game->createDate/1000) }}</td>
								<td><strong>Enemy Jungle Minions</strong></td>
								<td>{{ $game->neutralMinionsKilledEnemyJungle }}</td>
							</tr>
							<tr>
								<td><strong>Lane</strong></td>
								<td>{{ $game->lane }}</td>
								<td><strong>Doublekills</strong></td>
								<td>{{ $game->doubleKills }}</td>
								<td><strong>Tripplekills</strong></td>
								<td>{{ $game->tripleKills }}</td>
							</tr>
							<tr>
								<td><strong>Quadrakills</strong></td>
								<td>{{ $game->quadraKills }}</td>
								<td><strong>Pentakills</strong></td>
								<td>{{ $game->pentaKills }}</td>
								<td><strong>First blood kill</strong></td>
								<td>{{ $game->firstBloodKill }}</td>
							</tr>
							<tr>
								<td><strong>Tower kills (Team)</strong></td>
								<td>{{ $game->towerKills }}</td>
								<td><strong>Inhibitor kills (Team)</strong></td>
								<td>{{ $game->inhibitorKills }}</td>
								<td><strong>First tower (Team)</strong></td>
								<td>{{ $game->firstTower }}</td>
							</tr>
							<tr>
								<td><strong>First Dragon (Team)</strong></td>
								<td>{{ $game->firstDragon }}</td>
								<td><strong>First Baron (Team)</strong></td>
								<td>{{ $game->firstBaron }}</td>
								<td><strong>First blood (Team)</strong></td>
								<td>{{ $game->firstBlood }}</td>
							</tr>
							<tr>
								<td><strong>Dragons (Team)</strong></td>
								<td>{{ $game->dragonKills }}</td>
								<td><strong>Barons (Team)</strong></td>
								<td>{{ $game->baronKills }}</td>
								<td><strong></strong></td>
								<td></td>
							</tr>
						</table>
					</td>
				</tr>
			@endforeach
		</table>
	
<br/>
	
@stop
