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
		summoner_name = $(this).attr("data-summonername");
		summoner_data = current_game_players[summoner_id];
		
		if(typeof summoner_data != "undefined" && typeof summoner_data["runes"] != "undefined"){
			html  = '<h3 style="margin-top: 0px;">Runen von '+summoner_name.trim()+'</h3>';
			html += '<div class="runes_holder" style="border: none;"><div id="runepage_holder_current_game" class="rune_page_info"></div></div>';
			showLightbox(html, function(lightbox){
				for(var key in runes_temp) {
					html  = "<div class='rune_info_element' style='background: #fff;'>";
					html += "<img src='http://counterpick.de/uploads/runes/"+key+"_icon.png'>"+runes_temp[key]["count"]+"x "+runes_temp[key]["element"]["name"]+'<br>';
					html += "<span class='rune_desc'>"+runes_temp[key]["element"]["description"]+"</span>";
					html += "</div>";
					lightbox.find("#runepage_holder_current_game").append(html);
				}
			});
		}
	});

	$(".summoner_masteries_btn_currentgame").click(function(){
		summoner_id   = $(this).attr("data-summonerid");
		summoner_name = $(this).attr("data-summonername");
		summoner_data = current_game_players[summoner_id];
		
		if(typeof summoner_data != "undefined" && typeof summoner_data["masteries"] != "undefined"){
			html  = '<h3 style="margin-top: 0px;">Meisterschaften von '+summoner_name.trim()+'</h3>';
			html += '<div id="masteries_current_game"></div><div style="clear:both;"></div>';
			showLightbox(html, function(lightbox){
				lightbox.find("#masteries_current_game").mastery(summoner_data["masteries"], "http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/mastery/{MASTERY_ID}.png");
			});
		}
	});
});
</script>