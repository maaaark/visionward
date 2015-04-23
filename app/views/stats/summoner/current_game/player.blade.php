<tr class="current_game_player @if(isset($highlight) AND $highlight) highlight @endif"><!-- hier noch highlight setzen -->
	<td class="champ_icon"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $champion["key"] }}.png"></td>
	<td class="spells">
		<div><img src="/img/spells/{{ $player["spell1Id"] }}.png"></div>
		<div><img src="/img/spells/{{ $player["spell2Id"] }}.png"></div>
	</td>
	<td class="champion">
		<a href="/summoner/{{ $region }}/{{ $player["summonerName"] }}">{{ $player["summonerName"] }}</a>
		<div class="normal_wins">@if(isset($normal_wins) AND $normal_wins) <span>{{ $normal_wins }}</span> Wins @endif</div>
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
	<td class="ranked_wins no_small">
		@if(isset($league_data["wins"]) AND isset($league_data["losses"]))
			<span style="color:green;">{{ $league_data["wins"] }}</span> / <span style="color:red;">{{ $league_data["losses"] }}</span>
		@endif
	</td>
	<td class="summoner_datarunes">
		<a href="javascript:void(0)" class="summoner_runes_link_currentgame"
									 data-summonerid="{{ $player["summonerId"] }}"
									 data-summonername="{{ $player["summonerName"] }}">ansehen</a>
	</td>
	<td class="summoner_datamasteries">
		@if(isset($masteries) AND isset($masteries["offense"]))
		<button class="mastery_button summoner_masteries_btn_currentgame"
				data-summonerid="{{ $player["summonerId"] }}"
				data-summonername="{{ $player["summonerName"] }}">{{ $masteries["offense"] }} / {{ $masteries["defense"] }} / {{ $masteries["utility"] }}</button>
		@else
		<button class="mastery_button" disabled>0 / 0 / 0</button>
		@endif
	</td>
</tr>

<script>
	current_game_players[{{ $player["summonerId"] }}] 		       = [];
	current_game_players[{{ $player["summonerId"] }}]["runes"] 	   = '{{ json_encode($player["runes"]) }}';
	current_game_players[{{ $player["summonerId"] }}]["masteries"] = '{{ json_encode($player["masteries"]) }}';
</script>