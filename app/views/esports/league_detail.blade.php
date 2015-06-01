@extends('layouts.design_main')
@section('title', "Esports")
@section('esports_navi_elements')
		<div class="element active">Turnierliste</div>
		@if(isset($league->default_tournament) AND $league->default_tournament > 0)
			<a href="/esports/{{ trim($league_url) }}/tournament/{{ $league->default_tournament }}">
				<div class="element">Zum aktuellen Turnier</div>
			</a>
		@endif
@stop
@section('opener')
	<?php $dont_show_tournaments_dropdown = true; ?>
	@include('esports.tournament_header')
@stop

@section('content')
    <br/>
    <div class="row">
        <div class="col-md-5">
            <h2 class="headline">Turnierliste - {{ $league->label }}</h2>
            <div id="league_tournaments_holder" class="league_tournaments">
                <div style="padding: 20px; text-align: center; color: rgba(0,0,0,0.5);">Es wurden noch keine Turniere zu dieser Liga bekanntgegeben</div>
            </div>

            <script>
                var tournament_structure 	 = false;
                var tournament_active		 = false;
                var league_holder 			 = $("#league_tournaments_holder");
                var league_tournament_count  = 0;
                function addTournament2DOM(season, id, name){
                    if(tournament_structure == false){
                        html  = '<div id="tournament_tabs" class="tournament_tabs"></div>';
                        html += '<div id="tournament_contents" class="tournament_contents"></div>';
                        league_holder.html(html);
                        tournament_structure = true;
                    }

                    season_tab     = league_holder.find("#tournament_tabs .tab[data-season='"+season.trim()+"']");
                    if(typeof season_tab.html() == "undefined"){
                        league_tournament_count++;
                        html  = "<div class='tab' data-season='"+season.trim()+"'>"+season.trim()+"</div>";
                        league_holder.find("#tournament_tabs").html(league_holder.find("#tournament_tabs").html() + html);

                        html  = "<div class='tab_content' data-season='"+season.trim()+"'></div>";
                        league_holder.find("#tournament_contents").append(html);
                    }

                    // Link setzen
                    html = "<div data-season='"+season+"' class='tournament_el'><a href='/esports/{{ trim($league_url) }}/tournament/"+id+"'>"+name+"</a></div>";
                    league_holder.find("#tournament_contents .tab_content[data-season='"+season.trim()+"']").append(html);

                    if(tournament_active == false){
                        league_holder.find("#tournament_contents .active").removeClass("active");
                        league_holder.find("#tournament_tabs .active").removeClass("active");
                        league_holder.find("#tournament_contents .tab_content[data-season='"+season.trim()+"']").addClass("active");
                        league_holder.find("#tournament_tabs .tab[data-season='"+season.trim()+"']").addClass("active");
                        tournament_active = true;
                    }
                }

                @foreach($league_tournaments as $tournament)
                addTournament2DOM("{{ $tournament["season"] }}", {{ $tournament["tournament_id"] }}, "{{ $tournament["name"] }}");
                @endforeach
                $("#tournament_tabs").append('<div style="clear: both;"></div>');

                $(document).ready(function(){
                    $("#league_tournaments_holder #tournament_tabs .tab").click(function(){
                        league_holder.find("#tournament_contents .active").removeClass("active");
                        league_holder.find("#tournament_tabs .active").removeClass("active");

                        $(this).addClass("active");
                        league_holder.find("#tournament_contents .tab_content[data-season='"+$(this).attr("data-season").trim()+"']").addClass("active");
                    });
                });
            </script>
        </div>
        <div class="col-md-7">
            @if(isset($league->default_tournament) AND $league->default_tournament > 0)
                <h2 class="headline">NA LCS Spring Split</h2>
                <div class="standings_box">
                    <div class="title">
                        <img src="{{ $league->league_image }}" class="league_icon">
                        Tabelle
                    </div>
                    <?php $standings = Helpers::getTournamentStandings($league->default_tournament); ?>
                    @if(isset($standings) AND count($standings) > 0)
                        <table class="standings">
                            <thead>
                                <th colspan="3"></th>
                                <th colspan="2">Spiele</th>
                                <th>Punkte</th>
                            </thead>
                            <tbody>
                            @foreach($standings as $element)
                                <?php $team_data = Helpers::getTeamData($element["team_id"]); ?>
                                <tr>
                                    <td class="team_icon"><img src="{{ $team_data["logo_riot"] }}" class="team_icon_element"></td>
                                    <td class="rank">{{ $element->rank }}.</td>
                                    <td class="team_name"><a href="#">{{ $team_data["name"] }}</a></td>
                                    <td class="wins">{{ $element->wins }}</td>
                                    <td class="losses">{{ $element->losses }}</td>
                                    <td class="points">{{ intval($element->wins * 3) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else 
                        <div style="padding: 25px; color: rgba(0,0,0,0.6); text-align: center;">
                            Es ist noch keine Tabelle vorhanden.
                        </div>
                    @endif
                </div>
            </div>
            @else
                <h2 class="headline">Aktuelles Turnier</h2>
                <div style="color: rgba(0,0,0,0.6);text-align: center;padding: 25px;">
                    In dieser Liga wird momentan kein Turnier gespielt.
                </div>
            @endif
        </div>
    </div>

@stop