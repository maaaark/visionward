@extends('stats.header')
@section('content')
	<div class="base">
		<div class="summoner_bg" style="background-position: center 0px;">
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
				<div class="element" data-tab="3"><h1>Liga</h1>Coming soon ...</div>
				<div class="element" data-tab="4"><h1>Ranglisten Stats</h1>Coming soon ...</div>
				
				<div class="element" data-tab="5">
					{ include summoner/runes}
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

				$.get("/summoner/{{ $region }}/{{ $data->name }}/ajax", {"matchhistory": "true", sID: "{{ $data->summoner_id }}"}).done(function(data){
					$("#matchhistory_loader").html(data);
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
				});
			});
		});
	</script>
@stop