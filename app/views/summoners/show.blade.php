@extends('layouts.summoners',  array('stats' => $stats, 'rankedstats' => $rankedstats, 'summoner' => $summoner))
@section('title', $summoner->name)
@if($summoner->region == "euw")
	<?php $region = "EU-West"; ?>
@elseif($summoner->region == "na")
	<?php $region = "Nordamerika"; ?>
@elseif($summoner->region == "tr")
	<?php $region = "Türkei"; ?>
@elseif($summoner->region == "eune")
	<?php $region = "Europa Nord-Ost"; ?>
@elseif($summoner->region == "KR")
	<?php $region = "Korea"; ?>
@elseif($summoner->region == "ru")
	<?php $region = "Russland"; ?>
@else
	<?php $region = "none"; ?>
@endif
@section('subtitle', $region)
@section('header_image',"summoner_header.jpg")
@section('content')

	<table width="100%" class="profile">
		<tr>
			<td valign="top" width="130" style="text-align: center; padding-right: 15px;">
				<br/>
				<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/profileicon/{{ $summoner->profileIconId }}.png" width="100" class="img-circle" />
			</td>
			<td valign="top" width="150">
				<div class="profile_season_stats">
					<table style="margin-bottom: 0;text-align: center;" width="150">
						<tr>
							<td colspan="3">@if($summoner->summonerLevel ==30 and $summoner->solo_tier != 'none')<img src="/img/ranked/{{$summoner->solo_tier}}_{{$summoner->solo_division}}.png" width="130" class="img-circle" /></br><strong>{{$summoner->solo_tier}} {{$summoner->solo_division}} (56 LP)</strong>@endif</td>
						</tr>
					</table>
				</div>
			</td>
			<td valign="top">
				<table class="table table-striped" stlye="width: 100%;">
					<tr>
						<td width="150" class="attribute"><strong>Normale Siege</strong></td>
						<td class="attribute">{{ $summoner->unranked_wins}} Siege</td>
					</tr>
					@if($summoner->ranked_wins != 0 or $summoner->ranked_losses != 0)
					<tr>
						<td width="100" class="attribute"><strong>Gewertete Spiele</strong></td>
						<td class="attribute">{{ $summoner->ranked_wins+$summoner->ranked_losses}} Spiele</td>
					</tr>	
					<tr>
						<td width="100" class="attribute"><strong>Gewertete</br> Siege / Niederlagen</strong></td>
						<td class="attribute">
						@if($summoner->ranked_losses != 0)
							{{ $summoner->ranked_wins}} gewonnen / {{ $summoner->ranked_losses}} verloren<br/> 
							@if($summoner->ranked_wins/($summoner->ranked_wins+$summoner->ranked_losses)*100>=50)
								<span class="kda"><font style="color:#63A055">{{round($summoner->ranked_wins/($summoner->ranked_wins+$summoner->ranked_losses)*100,2)}}% Siegesrate</font></span></td>
							@else
								<span class="kda"><font style="color:#DB2D2D">{{round($summoner->ranked_wins/($summoner->ranked_wins+$summoner->ranked_losses)*100,2)}}% Siegesrate</font></span></td>
							@endif
						@else
							{{ $summoner->ranked_wins}} gewonnen / {{ $summoner->ranked_losses}} verloren<br/>
							<span class="kda"><font style="color:#63A055">100% Siegesrate</font></span></td>
						@endif
					</tr>
					@endif
				</table>
			</td>
		</tr>
	</table>

<h3 class="headline">Letzten Spiele</h3>
		<table class="table last_games">
			@foreach($games as $game)
				<?php 
					if($game["win"]==true) {
						$class = "success";
						$header_class = "win_header";
					} else {
						$class = "danger";
						$header_class = "loss_header";
					}
				?>
				<tr style="border-bottom: 0 !important;">
					<td class="<?php echo $header_class; ?>" colspan="6">
						@if($game->subType == "CAP_5x5")
							Team Builder
						@elseif($game->subType == "NORMAL")
							Normales Spiel
						@elseif($game->subType == "ARAM_UNRANKED_5x5")
							ARAM
						@elseif($game->subType == "RANKED_TEAM_5x5")
							Ranked Team
						@elseif($game->subType == "RANKED_TEAM_5x5")
							Ranked Team
						@elseif($game->subType == "RANKED_SOLO_5x5")
							Solo Ranked
						@elseif($game->subType == "RANKED_TEAM_3x3")
							Ranked 3er Team
						@endif
						
						 - {{ date("d.m.Y H:i", $game->createDate/1000) }} Uhr</td>
				</tr>
				<tr class="<?php echo $class; ?>">
					<td>
						<a href="/champions/{{ $game->champion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $game->champion->key }}.png" class="img-circle" width="35" /></a>
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
						{{ gmdate("i", $game->timePlayed) }} Minuten<br/>
						{{ $game->minionsKilled }} CS ( {{ $game->neutralMinionsKilled }} neutrale )
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
					<td><a href="#" class="toggle_game_details" id="{{ $game->id }}">Details</a></td>
					
				</tr>
				<tr class="game_detail_toggle game_details-{{ $game->id }}" >
					<td colspan="6" class="game_details">
						<table class="table table-striped">
							@if($game->incomplete == true)
							<tr>
								<td colspan="6"><span class="incomplete">This Match Data is incomplete! The Riot API doesn't provide all informations for this game.</span></td>
							</tr>
							@endif
							<tr>
								<td><strong>Gold verdient</strong></td>
								<td>{{ $game->goldEarned }}</td>
								<td><strong>Wards platziert</strong></td>
								<td>{{ $game->wardPlaced }}</td>
								<td><strong>Wards zerstört</strong></td>
								<td>{{ $game->wardKilled }}</td>
							</tr>
							<tr>
								<td><strong>Schaden bekommen</strong></td>
								<td>{{ $game->totalDamageTaken }}</td>
								<td><strong>Schaden verursacht</strong></td>
								<td>{{ $game->totalDamageDealt }}</td>
								<td><strong>Gesamte Heilung</strong></td>
								<td>{{ $game->totalHeal }}</td>
							</tr>
							<tr>
								<td><strong>Spieldauer</strong></td>
								<td>{{ gmdate("i", $game->timePlayed) }} min</td>
								<td><strong>Team</strong></td>
								<td>
									@if($game->teamId == 100)
										Blau
									@else
										Lila
									@endif
								</td>
								<td><strong>Türme zerstört</strong></td>
								<td>{{ $game->turretsKilled }}</td>
							</tr>
							<tr>
								<td><strong>Killingsprees</strong></td>
								<td>{{ $game->killingSprees }}</td>
								<td><strong>Datum</strong></td>
								<td>{{ date("d.m.Y H:i", $game->createDate/1000) }}</td>
								<td><strong>Gegnerische neutrale Monster</strong></td>
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
								<td><strong>Erstes Blut</strong></td>
								<td>{{ $game->firstBloodKill }}</td>
							</tr>
							<tr>
								<td><strong>Türme zerstört (Team)</strong></td>
								<td>{{ $game->towerKills }}</td>
								<td><strong>Inhibitoren zerstört (Team)</strong></td>
								<td>{{ $game->inhibitorKills }}</td>
								<td><strong>Erster Turm (Team)</strong></td>
								<td>{{ $game->firstTower }}</td>
							</tr>
							<tr>
								<td><strong>Erstes Blut (Team)</strong></td>
								<td>{{ $game->firstBlood }}</td>
								<td><strong>Drachen (Team)</strong></td>
								<td>{{ $game->dragonKills }}</td>
								<td><strong>Barons (Team)</strong></td>
								<td>{{ $game->baronKills }}</td>
							</tr>
						</table>
					</td>
				</tr>
			@endforeach
		</table>
	
<br/>
<h2 class="headline">Kommentare zu {{ $summoner->name }}</h2>
@include('layouts.disqus')
@stop

