<script>
var current_game_players = [];
</script>

<div class="col-md-6 current_game_holder left">
	<table class="table current_game_table">
		<tbody>
			<tr class="current_game_header">
				<td class="first">Champ</td>
				<td class="spells"></td>
				<td class="champion">Beschwörer</td>
				<td class="league no_mini">Liga</td>
				<td class="ranked_wins no_small">Ranked Wins</td>
				<td class="summoner_datarunes">Runen</td>
				<td class="summoner_datamasteries">Masteries</td>
			</tr>
			{{ $team1 }}
		</tbody>
	</table>
</div>

<div class="col-md-6 current_game_holder right">
	<table class="table current_game_table">
		<tbody>
			<tr class="current_game_header">
				<td class="first">Champ</td>
				<td class="spells"></td>
				<td class="champion">Beschwörer</td>
				<td class="league no_mini">Liga</td>
				<td class="ranked_wins no_small">Ranked Wins</td>
				<td class="summoner_datarunes">Runen</td>
				<td class="summoner_datamasteries">Masteries</td>
			</tr>
			{{ $team2 }}
		</tbody>
	</table>
</div>

<script>
$(document).ready(function(){
	$(".summoner_runes_link_currentgame").click(function(){
		summoner_id   = $(this).attr("data-summonerid");
		summoner_data = current_game_players[summoner_id];
		
		if(typeof summoner_data != "undefined" && typeof summoner_data["runes"] != "undefined"){
			showLightbox();
		}
	});
});
</script>