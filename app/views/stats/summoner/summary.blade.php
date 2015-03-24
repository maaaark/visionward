<div class="summoner_overview_line1" style="overflow:hidden;">
	<div class="summoner_title">Zusammenfassung</div>
	<div class="scroll_bar" style="height: 280px;">
		<!-- Tabelle wird per JSON gefüllt -->
		<table class="table" style="margin: 0px;" id="summoner_summary_table"></table>
	</div>
</div>

<script>
$(document).ready(function(){
	function addSummary(title, data){
		$("#summoner_summary_table").append('<tr><td colspan="2" class="title">'+title+'</td></tr>');
		if(typeof unranked_data["aggregatedStats"]["totalChampionKills"] != "undefined"){
			$("#summoner_summary_table").append("<tr><td>Kills</td><td class='val'>"+unranked_data["aggregatedStats"]["totalChampionKills"]+"</td></tr>");
		}
		if(typeof unranked_data["aggregatedStats"]["totalAssists"] != "undefined"){
			$("#summoner_summary_table").append("<tr><td>Assists</td><td class='val'>"+unranked_data["aggregatedStats"]["totalAssists"]+"</td></tr>");
		}
		if(typeof unranked_data["aggregatedStats"]["totalMinionKills"] != "undefined"){
			$("#summoner_summary_table").append("<tr><td>Lasthits</td><td class='val'>"+unranked_data["aggregatedStats"]["totalMinionKills"]+"</td></tr>");
		}
		if(typeof unranked_data["aggregatedStats"]["totalNeutralMinionsKilled"] != "undefined"){
			$("#summoner_summary_table").append("<tr><td>Jungle Lasthits</td><td class='val'>"+unranked_data["aggregatedStats"]["totalNeutralMinionsKilled"]+"</td></tr>");
		}
		if(typeof unranked_data["aggregatedStats"]["totalTurretsKilled"] != "undefined"){
			$("#summoner_summary_table").append("<tr><td>Türme zerstört</td><td class='val'>"+unranked_data["aggregatedStats"]["totalTurretsKilled"]+"</td></tr>");
		}
	}

	unranked_json = '{{ $data->unranked_data }}';
	if(unranked_json.trim() != ""){
		unranked_data = JSON.parse(unranked_json);
		if(typeof unranked_data["aggregatedStats"] != "undefined"){
			addSummary("Normal 5 gegen 5", unranked_data);
		}
	}

	ranked_json = '{{ $data->ranked_data }}';
	if(ranked_json.trim() != ""){
		ranked_data = JSON.parse(ranked_json);
		if(typeof ranked_data["aggregatedStats"] != "undefined"){
			addSummary("Ranked Solo Queue", ranked_data);
		}
	}

	teamranked_json = '{{ $data->teamranked_data }}';
	if(teamranked_json.trim() != ""){
		teamranked_data = JSON.parse(teamranked_json);
		if(typeof teamranked_data["aggregatedStats"] != "undefined"){
			addSummary("5er Ranked Team", teamranked_data);
		}	
	}
	loadScrollBars();
});
</script>