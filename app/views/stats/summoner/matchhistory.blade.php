<div class="matchhistory_element">
	<div class="match_title" style="@if($game['stats']['win'] == true) background-color:rgba(16, 81, 20, 0.8) @else background-color:rgba(81, 16, 16, 0.8)  @endif">
		{{ Helpers::niceGameMode($game["gameMode"]) }} - {{ Helpers::niceMatchMode($game["gameType"]) }} - {{ Helpers::niceSubType($game["subType"]) }}
	</div>
	<div class="background_image" style="background-image:url(http://counterpick.de/uploads/champions_skins/{CHAMPION_KEY_RIOT_LOW}_0_thumb.jpg);background-size:100%;">
		<div class="bg">
			<table class="matchhistory_table table">
				<tr>
					<td class="champion">
						<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $champion["key"] }}.png" class="img-circle">
						<div style="text-align:center;">{{ $champion["name"] }}</div>
					</td>
					<td class="stats">
						<div>@if(isset($game["stats"]["championsKilled"])){{ $game["stats"]["championsKilled"] }} @else 0 @endif <span>Kills</span></div>
						<div>@if(isset($game["stats"]["numDeaths"])){{ $game["stats"]["numDeaths"] }} @else 0 @endif <span>Tode</span></div>
						<div>@if(isset($game["stats"]["assists"])){{ $game["stats"]["assists"] }} @else 0 @endif <span>Assists</span></div>
					</td>
					<td class="items">
						@for($i = 0; $i < 6; $i++)
							<?php $item = $game["items"][$i]; ?>

							@if($i == 3) <div class="item_breaker show_mobile_mini"></div> @endif

							@if(isset($item["name"]) AND isset($item["item_id"]) AND $item["item_id"] > 0)
							<div class="item" style="background-image:url(http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/item/{{ $item->item_id }}.png);"></div>
							@else
							<div class="no_item"></div>
							@endif
						@endfor
					</td>
					<td class="spells">
						<div class="spell" style="background-image:url(/img/spells/{{ $game["spell1"] }}.png);"></div>
						<div class="spell" style="background-image:url(/img/spells/{{ $game["spell2"] }}.png);"></div>
					</td>
					<td class="farm no_mobile">
						<div>
							<span class="val">@if($game["stats"]["minionsKilled"]){{ $game["stats"]["minionsKilled"] }} @else 0 @endif</span>
							<img src="http://ddragon.leagueoflegends.com/cdn/5.2.1/img/ui/minion.png" alt="Lasthits" title="Lasthits">
						</div>
						<div>
							<span class="val">@if($game["stats"]["goldEarned"]){{ $game["stats"]["goldEarned"] }} @else 0 @endif</span>
							<img src="http://ddragon.leagueoflegends.com/cdn/5.2.1/img/ui/gold.png" alt="Gold" name="Gold">
						</div>
					</td>
					<td class="team team1 no_mobile_mini">
						<div class="title">Team 1</div>
						@if($game["teamId"]==100)
						<div class="player">
							<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $champion["key"] }}.png" class="img-circle">
							<span><b>{{ $summoner->name }}</b></span>
						</div>
						@endif
						@foreach($team1 as $player)
						<div class="player">
							<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $player["champion"]["key"] }}.png" class="img-circle">
							<span>{{ $player["name"] }}</span>
						</div>
						@endforeach
					</td>
					<td class="team team2 no_mobile_mini">
						<div class="title">Team 2</div>
						@if($game["teamId"]==200)
						<div class="player">
							<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $champion["key"] }}.png" class="img-circle">
							<span><b>{{ $summoner->name }}</b></span>
						</div>
						@endif
						@foreach($team2 as $player)
						<div class="player">
							<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $player["champion"]["key"] }}.png" class="img-circle">
							<span>{{ $player["name"] }}</span>
						</div>
						@endforeach
					</td>
				</tr>
			</table>
			<div class="more_details" data-id="{{ $game["gameId"] }}">
            Mehr Details anzeigen
         </div>
		</div>
	</div>
	<div class="more_details_holder" id="more_details_{{ $game["gameId"] }}">
      <table class="table matchhistory_table_detail">
         <tr>
         	<td>Jungle Monster get&ouml;tet</td>
         	<td class="val">@if(isset($game["stats"]["neutralMinionsKilledYourJungle"])) {{ $game["stats"]["neutralMinionsKilledYourJungle"] }}@else 0 @endif</td>
     	</tr>
         <tr>
         	<td>Gegnerische Jungle Monster get&ouml;tet</td>
         	<td class="val">@if(isset($game["stats"]["neutralMinionsKilledEnemyJungle"])) {{ $game["stats"]["neutralMinionsKilledEnemyJungle"] }}@else 0 @endif</td>
     	</tr>
         <tr>
         	<td>Gesamtschaden verursacht</td>
     		<td class="val">@if(isset($game["stats"]["totalDamageDealt"])) {{ $game["stats"]["totalDamageDealt"] }}@else 0 @endif</td>
 		</tr>
         <tr>
         	<td>Gesamtschaden verursacht an Champions</td>
         	<td class="val">@if(isset($game["stats"]["totalDamageDealtToChampions"])) {{ $game["stats"]["totalDamageDealtToChampions"] }}@else 0 @endif</td>
     	</tr>
         <tr>
         	<td>Gesamtschaden genommen</td>
         	<td class="val">@if(isset($game["stats"]["totalDamageTaken"])) {{ $game["stats"]["totalDamageTaken"] }}@else 0 @endif</td>
     	</tr>
         <tr>
         	<td>Zerst&ouml;rte T&uuml;rme</td>
     		<td class="val">@if(isset($game["stats"]["turretsKilled"])) {{ $game["stats"]["turretsKilled"] }}@else 0 @endif</td>
		</tr>
         <tr>
         	<td>Zerst&ouml;rte Inhibitore</td>
         	<td class="val">@if(isset($game["stats"]["barracksKilled"])) {{ $game["stats"]["barracksKilled"] }}@else 0 @endif</td>
     	</tr>
      </table>
   </div>
</div>
