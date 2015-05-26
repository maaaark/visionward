@extends('layouts.small_header')
@section('title', $match->team->name." vs. ".$match->team2->name." - ".$match->league->name)
@section('header_image',"pro_teams.jpg")
@section('content')

<h2 class="headline">{{ $match->team->name }} vs. {{ $match->team2->name }} - {{ $match->league->name }}</h2>

<table>
	<tr>
		<td>
			<div class="team_box">
				<a href="/teams/{{ $match->team->id }}/{{ $match->team->slug }}"><img src="/img/teams/logos/{{ $match->team->logo }}" width="150" /></a>
			</div>
		</td>
		<td width="200" style="text-align: center;">
			<h3>vs.</h3>
			@if($match->winner_team_id == 0)
				Noch kein Gewinner eingetragen
			@else
				<span id="show_result">Ergebnis zeigen</span>
				<span class="hidden_result">
					<h2>{{ $match->result_team_1 }}:{{ $match->result_team_2 }}</h2>
					@if($match->result_team_1 > $match->result_team_2)
					{{ $match->team->name }} gewinnt
					@else
					{{ $match->team2->name }} gewinnt
					@endif
				</span>
			@endif
		</td>
		<td>
			<div class="team_box">
                <a href="/teams/{{ $match->team2->id }}/{{ $match->team2->slug }}"><img src="/img/teams/logos/{{ $match->team2->logo }}" width="150" /></a>
			</div>
		</td>
	</tr>
</table>
<br/>
<ul class="nav nav-tabs" role="tablist" id="champion_tabs">
	<li class="active"><a href="#game1" role="tab" data-toggle="tab">Spiel 1</a></li>
	@foreach($match->children as $child)
	<li><a href="#game{{$child->id}}" role="tab" data-toggle="tab">{{$child->title}}</a></li>
	@endforeach
</ul>
<br/>
<div class="tab-content">
	<div class="tab-pane active" id="game1">
		<div class="match_result">
		<table class="result_table">
			<tr>
				<td valign="top">
						<span class="hidden_result">
						@if($match->winner_team_id == $match->team->id)
							<div class="match_winner">Gewinner</div>
						@else
							<div class="match_loser">Verlierer</div>
						@endif
						</span>
						<h2 class="headline_no_border">Lineup {{ $match->team->name }}</h2>
						<table class="table table-striped">

							<tr>
								<td width="120"><strong>
									Top-Lane
								</strong></td>
								<td>
									@if($match->team1_top_champion > 0)
									<a href="/champions/{{ $match->team1topchampion->key }}">
									<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team1topchampion->key }}.png" class="img-circle" width="20" />
									</a>
									@else
									<img src="/img/none.jpg" class="img-circle" width="20" />
									@endif
									&nbsp;&nbsp;<img src="/img/flags/{{ $match->team1topplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team1_top_player }}/{{ $match->team1topplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $match->team1_top_player }}">{{ $match->team1topplayer->nickname }}</a>
		                        </td>
							</tr>
		                    <tr>
								<td width="120"><strong>
									Jungle
								</strong></td>
								<td>
		                            
									@if($match->team1_jungle_champion != 0)
									<a href="/champions/{{ $match->team1junglechampion->key }}">
									<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team1junglechampion->key }}.png" class="img-circle" width="20" />
									</a>
									@else
									<img src="/img/none.jpg" class="img-circle" width="20" />
									@endif
									&nbsp;&nbsp;<img src="/img/flags/{{ $match->team1jungleplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team1_jungle_player }}/{{ $match->team1jungleplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $match->team1_jungle_player }}">{{ $match->team1jungleplayer->nickname }}</a>
		                        </td>
							</tr>
		                    <tr>
								<td width="120"><strong>
									Mid-Lane
								</strong></td>
								<td>
		                            
									@if($match->team1_mid_champion != 0)
									<a href="/champions/{{ $match->team1midchampion->key }}">
									<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team1midchampion->key }}.png" class="img-circle" width="20" />
									</a>
									@else
									<img src="/img/none.jpg" class="img-circle" width="20" />
									@endif
																		
									&nbsp;&nbsp;<img src="/img/flags/{{ $match->team1midplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team1_mid_player }}/{{ $match->team1midplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $match->team1_mid_player }}">{{ $match->team1midplayer->nickname }}</a>
		                        </td>
							</tr>
		                    <tr>
								<td width="120"><strong>
									AD-Carry
								</strong></td>
								<td>
		                            
									@if($match->team1_adc_champion != 0)
									<a href="/champions/{{ $match->team1adcchampion->key }}">
									<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team1adcchampion->key }}.png" class="img-circle" width="20" />
									</a>
									@else
									<img src="/img/none.jpg" class="img-circle" width="20" />
									@endif

									&nbsp;&nbsp;<img src="/img/flags/{{ $match->team1adcplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team1_adc_player }}/{{ $match->team1adcplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $match->team1_adc_player }}">{{ $match->team1adcplayer->nickname }}</a>
		                        </td>
							</tr>
		                    <tr>
								<td width="120"><strong>
									Support
								</strong></td>
								<td>
		                            
									
									@if($match->team1_support_champion != 0)
									<a href="/champions/{{ $match->team1supportchampion->key }}">
									<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team1supportchampion->key }}.png" class="img-circle" width="20" />
									</a>
									@else
									<img src="/img/none.jpg" class="img-circle" width="20" />
									@endif
									
									&nbsp;&nbsp;<img src="/img/flags/{{ $match->team1supportplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team1_support_player }}/{{ $match->team1supportplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $match->team1_support_player }}">{{ $match->team1supportplayer->nickname }}</a>
		                        </td>
							</tr>
						</table>
				</td>

				<td valign="top">
						<span class="hidden_result">
						@if($match->winner_team_id == $match->team2->id)
							<div class="match_winner">Gewinner</div>
						@else
							<div class="match_loser">Verlierer</div>
						@endif
						</span>
						<h2 class="headline_no_border">Lineup {{ $match->team2->name }}</h2>
						<table class="table table-striped">
							<tr>
								<td width="120"><strong>
									Top-Lane
								</strong></td>
								<td>
		                            
									
									@if($match->team2_top_champion != 0)
									<a href="/champions/{{ $match->team2topchampion->key }}">
									<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team2topchampion->key }}.png" class="img-circle" width="20" />
									</a>
									@else
									<img src="/img/none.jpg" class="img-circle" width="20" />
									@endif
									
									&nbsp;&nbsp;<img src="/img/flags/{{ $match->team2topplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team2_top_player }}/{{ $match->team2topplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $match->team2_top_player }}">{{ $match->team2topplayer->nickname }}</a>
		                        </td>
							</tr>
		                    <tr>
								<td width="120"><strong>
									Jungle
								</strong></td>
								<td>
		                            
									
									@if($match->team2_jungle_champion != 0)
									<a href="/champions/{{ $match->team2junglechampion->key }}">
									<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team2junglechampion->key }}.png" class="img-circle" width="20" />
									</a>
									@else
									<img src="/img/none.jpg" class="img-circle" width="20" />
									@endif
									
									&nbsp;&nbsp;<img src="/img/flags/{{ $match->team2jungleplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team2_jungle_player }}/{{ $match->team2jungleplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $match->team2_jungle_player }}">{{ $match->team2jungleplayer->nickname }}</a>
		                        </td>
							</tr>
		                    <tr>
								<td width="120"><strong>
									Mid-Lane
								</strong></td>
								<td>
		                            
									
									@if($match->team2_mid_champion != 0)
									<a href="/champions/{{ $match->team2midchampion->key }}">
									<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team2midchampion->key }}.png" class="img-circle" width="20" />
									</a>
									@else
									<img src="/img/none.jpg" class="img-circle" width="20" />
									@endif
									
									&nbsp;&nbsp;<img src="/img/flags/{{ $match->team2midplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team2_mid_player }}/{{ $match->team2midplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $match->team2_mid_player }}">{{ $match->team2midplayer->nickname }}</a>
		                        </td>
							</tr>
		                    <tr>
								<td width="120"><strong>
									AD-Carry
								</strong></td>
								<td>
		                            
									
									@if($match->team2_adc_champion != 0)
									<a href="/champions/{{ $match->team2adcchampion->key }}">
									<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team2adcchampion->key }}.png" class="img-circle" width="20" />
									</a>
									@else
									<img src="/img/none.jpg" class="img-circle" width="20" />
									@endif
									
									&nbsp;&nbsp;<img src="/img/flags/{{ $match->team2adcplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team2_adc_player }}/{{ $match->team2adcplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $match->team2_adc_player }}">{{ $match->team2adcplayer->nickname }}</a>
		                        </td>
							</tr>
		                    <tr>
								<td width="120"><strong>
									Support
								</strong></td>
								<td>
		                            
									
									@if($match->team2_support_champion != 0)
									<a href="/champions/{{ $match->team2supportchampion->key }}">
									<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team2supportchampion->key }}.png" class="img-circle" width="20" />
									</a>	
									@else
									<img src="/img/none.jpg" class="img-circle" width="20" />
									@endif
									
									&nbsp;&nbsp;<img src="/img/flags/{{ $match->team2supportplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team2_support_player }}/{{ $match->team2supportplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $match->team2_support_player }}">{{ $match->team2supportplayer->nickname }}</a>
		                        </td>
							</tr>
						</table>
			
				</td>
			</tr>
		</table>

		</div>
	</div>
	@foreach($match->children as $child)
		<div class="tab-pane" id="game{{$child->id}}">
			<table class="result_table">
			<tr>
				<td valign="top">
						<span class="hidden_result">
						@if($child->winner_team_id == $child->team->id)
							<div class="match_winner">Gewinner</div>
						@else
							<div class="match_loser">Verlierer</div>
						@endif
						</span>
						<h2 class="headline_no_border">Lineup {{ $child->team->name }}</h2>
						<table class="table table-striped">

							<tr>
								<td width="120"><strong>
									Top-Lane
								</strong></td>
								<td>
		                            <a href="/champions/{{ $child->team1topchampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $child->team1topchampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team1topplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team1_top_player }}/{{ $match->team1topplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $child->team1_top_player }}">{{ $child->team1topplayer->nickname }}</a>
		                        </td>
							</tr>
		                    <tr>
								<td width="120"><strong>
									Jungle
								</strong></td>
								<td>
		                            <a href="/champions/{{ $child->team1junglechampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $child->team1junglechampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team1jungleplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team1_jungle_player }}/{{ $match->team1jungleplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $child->team1_jungle_player }}">{{ $child->team1jungleplayer->nickname }}</a>
		                        </td>
							</tr>
		                    <tr>
								<td width="120"><strong>
									Mid-Lane
								</strong></td>
								<td>
		                            <a href="/champions/{{ $child->team1midchampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $child->team1midchampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team1midplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team1_mid_player }}/{{ $match->team1midplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $child->team1_mid_player }}">{{ $child->team1midplayer->nickname }}</a>
		                        </td>
							</tr>
		                    <tr>
								<td width="120"><strong>
									AD-Carry
								</strong></td>
								<td>
		                            <a href="/champions/{{ $child->team1adcchampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $child->team1adcchampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team1adcplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team1_adc_player }}/{{ $match->team1adcplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $child->team1_adc_player }}">{{ $child->team1adcplayer->nickname }}</a>
		                        </td>
							</tr>
		                    <tr>
								<td width="120"><strong>
									Support
								</strong></td>
								<td>
		                            <a href="/champions/{{ $child->team1supportchampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $child->team1supportchampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team1supportplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team1_support_player }}/{{ $match->team1supportplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $child->team1_support_player }}">{{ $child->team1supportplayer->nickname }}</a>
		                        </td>
							</tr>
						</table>
				</td>

				<td valign="top">
						<span class="hidden_result">
						@if($child->winner_team_id == $child->team2->id)
							<div class="match_winner">Gewinner</div>
						@else
							<div class="match_loser">Verlierer</div>
						@endif
						</span>
						<h2 class="headline_no_border">Lineup {{ $child->team2->name }}</h2>
						<table class="table table-striped">
							<tr>
								<td width="120"><strong>
									Top-Lane
								</strong></td>
								<td>
		                            <a href="/champions/{{ $child->team2topchampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $child->team2topchampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team2topplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team2_top_player }}/{{ $match->team2topplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $child->team2_top_player }}">{{ $child->team2topplayer->nickname }}</a>
		                        </td>
							</tr>
		                    <tr>
								<td width="120"><strong>
									Jungle
								</strong></td>
								<td>
		                            <a href="/champions/{{ $child->team2junglechampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $child->team2junglechampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team2jungleplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team2_jungle_player }}/{{ $match->team2jungleplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $child->team2_jungle_player }}">{{ $child->team2jungleplayer->nickname }}</a>
		                        </td>
							</tr>
		                    <tr>
								<td width="120"><strong>
									Mid-Lane
								</strong></td>
								<td>
		                            <a href="/champions/{{ $child->team2midchampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $child->team2midchampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team2midplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team2_mid_player }}/{{ $match->team2midplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $child->team2_mid_player }}">{{ $child->team2midplayer->nickname }}</a>
		                        </td>
							</tr>
		                    <tr>
								<td width="120"><strong>
									AD-Carry
								</strong></td>
								<td>
		                            <a href="/champions/{{ $child->team2adcchampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $child->team2adcchampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team2adcplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team2_adc_player }}/{{ $match->team2adcplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $child->team2_adc_player }}">{{ $child->team2adcplayer->nickname }}</a>
		                        </td>
							</tr>
		                    <tr>
								<td width="120"><strong>
									Support
								</strong></td>
								<td>
		                            <a href="/champions/{{ $child->team2supportchampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $child->team2supportchampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team2supportplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team2_support_player }}/{{ $match->team2supportplayer->nickname }}" class="player_tooltip" rel="{{ 
		                                $child->team2_support_player }}">{{ $child->team2supportplayer->nickname }}</a>
		                        </td>
							</tr>
						</table>
			
				</td>
			</tr>
		</table>
		</div>
	@endforeach
</div>
<br/>
		<h2 class="headline_no_border">Mehr Informationen</h2>
		<table class="table table-striped">
			<tr>
				<td width="120"><strong>Liga / Turnier</strong></td>
				<td><a href="/leagues/{{ $match->league->id }}/{{ $match->league->slug }}"><img src="/img/teams/{{ $match->league->logo }}" height="20" />&nbsp;&nbsp;{{ $match->league->name }} - {{ date("d.m.Y - H:i",strtotime($match->game_date)) }} Uhr</a></td>
			</tr>
			<tr>
				<td width="120"><strong>Modus</strong></td>
				<td>
					Best of {{ $match->bestof }}
				</td>
			</tr>
			<!--<tr>
				<td width="120"><strong>VOD Link</strong></td>
				<td>
					@for($i = 1; $match->bestof >= $i; $i++)
						Match #{{ $i }}<br/>
					@endfor
					<a href="#"></a>
				</td>
			</tr>-->
		</table>				
				

<br/>
@include("layouts.disqus")	
@stop