<tr class="current_game_player"><!-- hier noch highlight setzen -->
	<td class="champ_icon"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $champion["key"] }}.png"></td>
	<td class="spells">
		<div><img src="/img/spells/{{ $player["spell1Id"] }}.png"></div>
		<div><img src="/img/spells/{{ $player["spell2Id"] }}.png"></div>
	</td>
	<td class="champion">
		<a href="/summoner/{{ $region }}/{{ $player["summonerName"] }}">{{ $player["summonerName"] }}</a>
		<div class="normal_wins no_small">@if(isset($normal_wins) AND $normal_wins) <span>{{ $normal_wins }}</span> Normal-Wins @endif</div>
		<div class="normal_wins just_small">@if(isset($normal_wins) AND $normal_wins) <span>{{ $normal_wins }}</span> Wins @endif</div>
	</td>
	<td class="league no_mini">
		@if(isset($league_data["tier"]) AND $league_data["tier"] AND isset($league_data["division"]))
			<img src="{{ asset('img/stats/tiers/'. $league_data["tier"] .'_'. $league_data["division"] .'.png') }}">
			{{ $league_data["tier_transform"] }} {{ $league_data["division"] }}
			<div class="lp"><span>{{ $league_data["leaguePoints"] }}</span> LP</div>
		@else
			<span style="color:rgba(0,0,0,0.6);">Noch nicht eingestuft</span>
		@endif
	</td>
	@if(isset($league_data["wins"]) AND isset($league_data["lossees"]))
	<td class="ranked_wins no_small">
		<div>Ranked Wins:</div>
		<span style="color:green;">{{ $league_data["wins"] }}</span> / <span style="color:red;">{{ $league_data["losses"] }}</span>
	</td>
	@endif
	<td class="summoner_datarunes">
		<div>Runen</div>
		<div>0 / 9 / 21</div>
	</td>
</tr>