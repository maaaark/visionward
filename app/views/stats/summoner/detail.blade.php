@extends('stats.header')
@section('opener')
	<div class="summoner_bg" style="background-image:url({{ asset('img/stats/fizz_summoner_bg.jpg') }});">
		<div class="mid_pos">
			<div class="summoner_update_loader" @if(isset($updates_this_time) && $updates_this_time) style="display:block;" @endif>
				<img src="{{ URL::asset('img/stats/ajax-loader.gif') }}" class="loader_img">
				<div class="first">Die Daten des Beschw&ouml;rers werden gerade aktualisiert ...</div>
				<div class="second">Dies kann wenige Minuten dauern</div>
			</div>

			<div class="summoner_name">
				{{ $data->name }}
				<div class="info">Level: {{ $data->summonerLevel }} | {{ $region_name }}</div>
			</div>
			
			<div class="summoner_navi" id="summoner_navi">
				<div class="element" data-tab="1" data-hash="about">&Uuml;bersicht</div>
				<div class="element" data-tab="2" data-hash="history">Spielverlauf</div>
				<div class="element" data-tab="3" data-hash="league">Liga</div>
				<div class="element" data-tab="4" data-hash="ranked_stats">Ranglisten Stats</div>
				<div class="element" data-tab="5" data-hash="runes">Runen</div>
			</div>
		</div>
	</div>
@stop

@section('content')
	<div class="base">
		<div class="col-md-12">
			<div id="summoner_tabs_content" class="summoner_tabs_content">
				<div class="element" data-tab="1">
					<div class="col-md-12" style="margin-bottom: 15px;margin-top: 15px;">
						<div class="summoner_overview_line1 current_game_main_holder">
							<div class="summoner_title">Live-Game</div>
							<div id="current_game_content">
								<div style="padding:35px;color:rgba(0,0,0,0.6);text-align:center;">
									<div style="margin-bottom: 8px;"><img src="{{ URL::asset('img/stats/ajax-loader.gif') }}" style="height: 45px;"></div>
									Es wird &uuml;berpr&uuml;ft ob {{ $data->name }} gerade spielt.<br/>Einen Moment bitte ...
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-4">
						{{ $summary }}
					</div>
					<div class="col-md-8 ranked_summary">
						{{ $summary_ranked }}
					</div>
				</div>
				<div class="element" data-tab="2"><h1>Spielverlauf</h1><div id="matchhistory_loader"><div class="loader">Die Daten k&ouml;nnen nicht geladen werden ...</div></div></div>
				<div class="element" data-tab="3"><h1>Liga</h1><div id="league_loader"><div class="loader">Die Daten k&ouml;nnen nicht geladen werden ...</div></div></div>
				<div class="element" data-tab="4"><h1>Ranglisten Stats</h1><div id="ranked_stats_loader"><div class="loader">Die Daten k&ouml;nnen nicht geladen werden ...</div></div></div>
				
				<div class="element" data-tab="5">
					@include('stats.summoner.runes')
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function(){
			var tabs_element_count = 0;
			$("#summoner_tabs_content .element").each(function(){
				if(tabs_element_count == 0){
					$("#summoner_navi .element[data-tab='1']").addClass("active");
					$(this).addClass("active");
				}
				tabs_element_count++;
			});
			
			$("#summoner_navi .element").click(function(){
				tab_id = $(this).attr("data-tab");
				$("#summoner_navi .active").removeClass("active");
				$(this).addClass("active");
				$("#summoner_tabs_content .active").removeClass("active");
				$("#summoner_tabs_content .element[data-tab='"+tab_id+"']").addClass("active");
				location.hash = '#'+$(this).attr("data-hash");
			});
			
			$("#summoner_tabs_content .loader").each(function(){
				html  = '<div style="text-align:center;padding: 35px;">';
				html += "<img src='{{ URL::asset('img/stats/ajax-loader.gif') }}' style='width: 70%;max-width: 150px;'>";
				html += "<div style='color: rgba(0,0,0,0.6);margin-top: 25px;'>Einen moment bitte, die Daten werden geladen ...</div>";
				html += "</div>";
				$(this).html(html);
			});
			
			start_hash = location.hash+" ";
			if(start_hash.trim() != ""){
				element = $("#summoner_navi .element[data-hash='"+start_hash.trim().replace("#", "")+"'");
				if(typeof element.html() != "undefined"){
					$("#summoner_navi .active").removeClass("active");
					element.addClass("active");
					tab_id = element.attr("data-tab");
					$("#summoner_tabs_content .active").removeClass("active");
					$("#summoner_tabs_content .element[data-tab='"+tab_id+"']").addClass("active");
				}
			}

			$.get("/summoner/{{ $region }}/{{ $data->name }}/ajax", {"current_game": "true", sID: "{{ $data->summoner_id }}"}).done(function(data){
				if(data.trim() == "not_in_game"){
					$("#current_game_content").html("<div style='padding:35px;text-align:center;color:rgba(0,0,0,0.6);'>{{ $data->name }} spielt gerade nicht</div>");
				} else {
					$("#current_game_content").html(data);
				}

				$.get("/summoner/{{ $region }}/{{ $data->name }}/ajax", {"data": "true", sID: "{{ $data->summoner_id }}"}).done(function(data){
					$(".summoner_update_loader").animate({"opacity":"0"},500, "linear", function(){$(this).hide();});

					json = JSON.parse(data);

					// Matchhistory
					if(typeof json["matchhistory"] != "undefined"){
						$("#matchhistory_loader").html(json["matchhistory"]);
					    $(".matchhistory_element .more_details").click(function(){
					       element = $("#more_details_"+$(this).attr("data-id"));
					       if(element.hasClass("active")){
					          element.removeClass("active");
					          $(this).html("Mehr Details anzeigen");
					       } else {
					          element.addClass("active");
					          $(this).html("Details ausblenden");
					       }
					    });
				    } else {
				    	$("#matchhistory_loader").html("Aufgrund eines unbekannten Fehlers konnte der Spielverlauf leider nicht geladen werden.");
				    }

				    // Ranked-Stats
				    if(typeof json["ranked_stats"] != "undefined"){
				    	ranked_stats = JSON.parse(json["ranked_stats"]);
				    	html  = '<table class="table table-bordered ranked_data_table sortable" id="ranked_stats_data_table">';
				    	html += '<thead>'
				    	html += '<th>Champion</th><th>Spiele (Gewonnen / Verloren)</th><th>Winrate</th><th>Kills &#216; </th><th>Tode &#216;</th><th>Assists &#216;</th><th>Lasthits &#216;</th>';
				    	html += '</thead><tbody>';
				    	for(key in ranked_stats){
				    		element = ranked_stats[key];
				    		
				    		html += '<tr>'
				    		html += '<td class="champ_info"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/'+element["championKey"]+'.png" class="champ_icon"> ';
				    		html += '<span>'+element["championName"]+'</span></td>';
				    		html += '<td>'+element["totalSessionsPlayed"]+' ('+element["totalSessionsWon"]+' / '+element["totalSessionsLost"]+')</td>';
				    		html += '<td>'+(element["totalSessionsWon"] / element["totalSessionsPlayed"] * 100).toFixed(2)+' %</td>';
				    		html += '<td>'+(element["totalChampionKills"] / element["totalSessionsPlayed"]).toFixed(1)+'</td>';
				    		html += '<td>'+(element["totalDeathsPerSession"] / element["totalSessionsPlayed"]).toFixed(1)+'</td>';
				    		html += '<td>'+(element["totalAssists"] / element["totalSessionsPlayed"]).toFixed(1)+'</td>';
				    		html += '<td>'+(element["totalMinionKills"] / element["totalSessionsPlayed"]).toFixed(1)+'</td>';
				    		html += '</tr>';
				    	}
				    	html += '</tbody></table>';
				    	$("#ranked_stats_loader").html(html);
				    	$("#ranked_stats_data_table").tablesorter({sortList:[[1,1]]});
				    } else {
				    	$("#ranked_stats_loader").html("Aufgrund eines unbekannten Fehlers konnten die Ranked-Stats leider nicht geladen werden.");
				    }

				    // Liga
				    if(typeof json["league"] != "undefined"){
						league = JSON.parse(json["league"]);

						if(typeof league["info"] != "undefined" && typeof league["division"] != "undefined"){
							$("#league_loader").html('<div id="league_navi" class="league_navi"><div class="tier">'+league["info"]["tier"]+'</div></div><div id="league_holder"></div>');
							$("#league_loader").addClass("summoner_league");
							for(division in league["division"]){
								element = league["division"][division];
								
								class_addition = "";
								if(division == league["info"]["summoner_division"]){
									class_addition = " current";
								}

								$("#league_loader #league_navi").append('<div class="league_btn'+class_addition+'" data-d="'+division+'">'+division+'</div>');

								table_html  = '<table class="league_table table table-bordered">';
								table_html += '<thead>';
								table_html += '<th>Rang</th>';
								table_html += '<th>Spieler</th>';
								table_html += '<th>Siege</th>';
								table_html += '<th>Punkte</th>';
								table_html += '</thead><tbody>';

								rank = 0;
								for(player_count in league["division"][division]){
									player = league["division"][division][player_count];
									tr_highlight = "";
									if(typeof player["highlight"] != "undefined" && player["highlight"] == "highlight"){
										tr_highlight = "highlight";
									}

									table_html += '<tr class="'+tr_highlight+'">';

									rank++;
									table_html += '<td class="rank">'+rank+'</td>';
									table_html += '<td class="summoner"><img class="summ_icon" src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/profileicon/'+player["summonerIcon"]+'.png">';
									table_html += '<span>'+player["playerOrTeamName"]+'</span></td>';
									table_html += '<td>'+player["wins"]+'</td>';

									if(typeof player["miniSeries"] != "undefined" && typeof player["miniSeries"]["progress"] != "undefined"){
										// Miniserie anzeigen
										serie = player["miniSeries"];
										progress = serie["progress"].toUpperCase();
										for(i = 0; i < 5; i++){
											progress = progress.replace("N", '<div class="icon notplayed"></div>');
											progress = progress.replace("L", '<div class="icon loss"></div>');
											progress = progress.replace("W", '<div class="icon win"></div>');
										}

										table_html += '<td class="points serie">'+progress+'</td>';
									} else {
										// Liga-Punkte anzeigen
										table_html += '<td class="points">'+player["leaguePoints"]+'</td>';
									}
									table_html += '</tr>';
								}
								table_html += '</tbody></table>';
								$("#league_loader #league_holder").append('<div id="league_'+division+'" class="league_element'+class_addition+'"></div>');
								$("#league_loader #league_holder #league_"+division).html(table_html);
							}

							$("#league_loader #league_navi .league_btn").click(function(){
								division = $(this).attr("data-d");
								$("#league_loader #league_navi .current").removeClass("current");
								$("#league_loader #league_holder .current").removeClass("current");
								$(this).addClass("current");
								$("#league_loader #league_holder #league_"+division).addClass("current");
							});
						} else {
							$("#league_loader").html("Aufgrund eines unbekannten Fehlers konnte die Liga leider nicht geladen werden.");
						}
				    } else {
				    	$("#league_loader").html("Aufgrund eines unbekannten Fehlers konnte die Liga leider nicht geladen werden.");
				    }

				    // Runen
				    if(typeof json["runes"] != "undefined"){
				    	loadRunes(JSON.parse(json["runes"]));
				    }
				});
			});
		});
	</script>
@stop