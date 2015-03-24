<div class="summoner_overview_line1">
	<div class="col-md-4 ranked_element" id="team3_ranked_summary">
		<div class="summoner_title"><center>3er Ranked</center></div>
		<div class="holder">
			@if ($data->team3_division AND $data->team3_division != "none")
				<div class="tier_logo" style="background-image:url({{ asset('img/stats/tiers/') }});"></div>
				<div class="league">{RANKED_TEAM_3X3_TIER} {RANKED_TEAM_3X3_DIVISION}</div>
				<div class="points">{RANKED_TEAM_3X3_LEAGUE_POINTS} Punkte</div>
				<div class="win_loss wins"><span class="val">{RANKED_TEAM_3X3_WINS}</span> gewonnen</div>
				<div class="win_loss losses"><span class="val">{RANKED_TEAM_3X3_LOSSES}</span> verloren</div>
			@else
				<div class="tier_logo" style="background-image:url({{ asset('img/stats/tiers/unknown.png') }});"></div>
				<div class="not_played">Nicht gespielt</div>
			@endif
		</div>
	</div>
	<div class="col-md-4 ranked_element" id="solo_ranked_summary">
		<div class="summoner_title"><center>Ranked Solo/Duo</center></div>
		<div class="holder">
			@if ($data->solo_division AND $data->solo_division != "none")
				<div class="tier_logo" style="background-image:url({DOMAIN}/assets/img/tiers/{RANKED_SOLO_5X5_TIER}_{RANKED_SOLO_5X5_DIVISION}.png);"></div>
				<div class="league">{RANKED_SOLO_5X5_TIER} {RANKED_SOLO_5X5_DIVISION}</div>
				<div class="points">{RANKED_SOLO_5X5_LEAGUE_POINTS} Punkte</div>
				<div class="win_loss wins"><span class="val">{RANKED_SOLO_5X5_WINS}</span> gewonnen</div>
				<div class="win_loss losses"><span class="val">{RANKED_SOLO_5X5_LOSSES}</span> verloren</div>
			@else
				<div class="tier_logo" style="background-image:url({{ asset('img/stats/tiers/unknown.png') }});"></div>
				<div class="not_played">Nicht gespielt</div>
			@endif
		</div>
	</div>
	<div class="col-md-4 ranked_element" id="team5_ranked_summary">
		<div class="summoner_title"><center>5er Ranked</center></div>
		<div class="holder">
			@if ($data->team5_division AND $data->team5_division != "none")
				<div class="tier_logo" style="background-image:url({DOMAIN}/assets/img/tiers/{RANKED_TEAM_5X5_TIER}_{RANKED_TEAM_5X5_DIVISION}.png);"></div>
				<div class="league">{RANKED_TEAM_5X5_TIER} {RANKED_TEAM_5X5_DIVISION}</div>
				<div class="points">{RANKED_TEAM_5X5_LEAGUE_POINTS} Liga Punkte</div>
				<div class="win_loss wins"><span class="val">{RANKED_TEAM_5X5_WINS}</span> gewonnen</div>
				<div class="win_loss losses"><span class="val">{RANKED_TEAM_5X5_LOSSES}</span> verloren</div>
			@else
				<div class="tier_logo" style="background-image:url({{ asset('img/stats/tiers/unknown.png') }});"></div>
				<div class="not_played">Nicht gespielt</div>
			@endif
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	function addRankedSummary(type, data){
		unknown_icon_png = "{{ asset('img/stats/tiers/unknown.png') }}";
		if(data == false || typeof data["tier"] == "undefined"){
			$("#"+type+" .holder").html("<div class='tier_logo' style='background-image:url("+unknown_icon_png+");'></div><div class='not_played'>Nicht gespielt</div>");
		} else {
			current_tier_icon = unknown_icon_png.replace("unknown.png", data["tier"]+"_"+data["division"]+".png");
			html  = '<div class="tier_logo" style="background-image:url('+current_tier_icon+');"></div>';
			html += '<div class="league">'+data["tier"]+' '+data["division"]+'</div>';
			html += '<div class="points">'+data["league_points"]+' Liga Punkte</div>';
			html += '<div class="win_loss wins"><span class="val">'+data["wins"]+'</span> gewonnen</div>';
			html += '<div class="win_loss losses"><span class="val">'+data["losses"]+'</span> verloren</div>';
			$("#"+type+" .holder").html(html);
		}
	}

	ranked_solo  = false;
	ranked_team3 = false;
	ranked_team5 = false;
	json_data = '{{ $data->ranked_summary }}';
	if(json_data.trim() != ""){
		summary   = JSON.parse(json_data);

		if(typeof summary["RANKED_SOLO_5x5"] != "undefined"){
			ranked_solo = summary["RANKED_SOLO_5x5"];
		}

		if(typeof summary["RANKED_TEAM_3x3"] != "undefined"){
			ranked_team3 = summary["RANKED_TEAM_3x3"];
		}

		if(typeof summary["RANKED_TEAM_5x5"] != "undefined"){
			ranked_team5 = summary["RANKED_TEAM_5x5"];
		}
	}
	addRankedSummary("team3_ranked_summary", ranked_team3);
	addRankedSummary("solo_ranked_summary", ranked_solo);
	addRankedSummary("team5_ranked_summary", ranked_team5);
});
</script>