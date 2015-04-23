<div class="summoner_overview_line1" style="overflow:hidden;">
	<div class="summoner_title">Zusammenfassung</div>
	<div class="scroll_bar" style="height: 280px;">
		<!-- Tabelle wird per JSON gefüllt -->
		<table class="table" style="margin: 0px;" id="summoner_summary_table"></table>
	</div>
</div>

<script>
$(document).ready(function(){
	function number_format (number, decimals, dec_point, thousands_sep){
		number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
		var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function (n, prec){
			var k = Math.pow(10, prec);
			return '' + Math.round(n * k) / k;
		};

		// Fix for IE parseFloat(0.55).toFixed(0) = 0;
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		if (s[0].length > 3) {
			s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		}
		if ((s[1] || '').length < prec) {
			s[1] = s[1] || '';
			s[1] += new Array(prec - s[1].length + 1).join('0');
		}
		return s.join(dec);
	}

	function addSummary(title, data){
		$("#summoner_summary_table").append('<tr><td colspan="2" class="title">'+title+'</td></tr>');
		if(typeof data["aggregatedStats"]["totalChampionKills"] != "undefined"){
			$("#summoner_summary_table").append("<tr><td>Kills</td><td class='val'>"+number_format(data["aggregatedStats"]["totalChampionKills"], 0 , ",", ".")+"</td></tr>");
		}
		if(typeof data["aggregatedStats"]["totalAssists"] != "undefined"){
			$("#summoner_summary_table").append("<tr><td>Assists</td><td class='val'>"+number_format(data["aggregatedStats"]["totalAssists"], 0 , ",", ".")+"</td></tr>");
		}
		if(typeof data["aggregatedStats"]["totalMinionKills"] != "undefined"){
			$("#summoner_summary_table").append("<tr><td>Lasthits</td><td class='val'>"+number_format(data["aggregatedStats"]["totalMinionKills"], 0 , ",", ".")+"</td></tr>");
		}
		if(typeof data["aggregatedStats"]["totalNeutralMinionsKilled"] != "undefined"){
			$("#summoner_summary_table").append("<tr><td>Jungle Lasthits</td><td class='val'>"+number_format(data["aggregatedStats"]["totalNeutralMinionsKilled"], 0 , ",", ".")+"</td></tr>");
		}
		if(typeof data["aggregatedStats"]["totalTurretsKilled"] != "undefined"){
			$("#summoner_summary_table").append("<tr><td>Türme zerstört</td><td class='val'>"+number_format(data["aggregatedStats"]["totalTurretsKilled"], 0 , ",", ".")+"</td></tr>");
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