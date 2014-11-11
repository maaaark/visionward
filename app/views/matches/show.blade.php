@extends('layouts.small_header')
@section('title', $match->team->name." vs. ".$match->team2->name." - ".$match->league->name)
@section('header_image',"pro_teams.jpg")
@section('content')

<h2 class="headline">{{ $match->team->name }} vs. {{ $match->team2->name }} - {{ $match->league->name }}</h2>

<div class="match_result">
<table class="result_table">
	<tr>
		<td valign="top">
			<div class="team_box">
				<img src="/img/teams/logos/{{ $match->team->logo }}" width="150" />
			</div>
				<br/>
				<h2 class="headline_no_border">Lineup {{ $match->team->name }}</h2>
				<table class="table table-striped">

					<tr>
						<td width="120"><strong>
							Top-Lane
						</strong></td>
						<td>
                            <a href="/champions/{{ $match->team1topchampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team1topchampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team1topplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team1_top_player }}/{{ $match->team1topplayer->nickname }}" class="player_tooltip" rel="{{ 
                                $match->team1_top_player }}">{{ $match->team1topplayer->nickname }}</a>
                        </td>
					</tr>
                    <tr>
						<td width="120"><strong>
							Jungle
						</strong></td>
						<td>
                            <a href="/champions/{{ $match->team1junglechampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team1junglechampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team1jungleplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team1_jungle_player }}/{{ $match->team1jungleplayer->nickname }}" class="player_tooltip" rel="{{ 
                                $match->team1_jungle_player }}">{{ $match->team1jungleplayer->nickname }}</a>
                        </td>
					</tr>
                    <tr>
						<td width="120"><strong>
							Mid-Lane
						</strong></td>
						<td>
                            <a href="/champions/{{ $match->team1midchampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team1midchampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team1midplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team1_mid_player }}/{{ $match->team1midplayer->nickname }}" class="player_tooltip" rel="{{ 
                                $match->team1_mid_player }}">{{ $match->team1midplayer->nickname }}</a>
                        </td>
					</tr>
                    <tr>
						<td width="120"><strong>
							AD-Carry
						</strong></td>
						<td>
                            <a href="/champions/{{ $match->team1adcchampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team1adcchampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team1adcplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team1_adc_player }}/{{ $match->team1adcplayer->nickname }}" class="player_tooltip" rel="{{ 
                                $match->team1_adc_player }}">{{ $match->team1adcplayer->nickname }}</a>
                        </td>
					</tr>
                    <tr>
						<td width="120"><strong>
							Support
						</strong></td>
						<td>
                            <a href="/champions/{{ $match->team1supportchampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team1supportchampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team1supportplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team1_support_player }}/{{ $match->team1supportplayer->nickname }}" class="player_tooltip" rel="{{ 
                                $match->team1_support_player }}">{{ $match->team1supportplayer->nickname }}</a>
                        </td>
					</tr>

				</table>
			
		</td>
		<td width="200" valign="top" class="result_value">
			
			<h3>vs.</h3>
			@if($match->winner_team_id == 0)
				Noch kein Gewinner eingetragen
			@else
				<span id="show_result">Ergebnis zeigen</span>
				<span class="hidden_result">
					<h2>{{ $match->result_team_1 }}:{{ $match->result_team_2 }}</h2>
					{{ $match->winner->name }} gewinnt
				</span>
			@endif
		</td>
		<td valign="top">
			<div class="team_box">
				<img src="/img/teams/logos/{{ $match->team2->logo }}" width="150" />
			</div>
				<br/>
				<h2 class="headline_no_border">Lineup {{ $match->team2->name }}</h2>
				<table class="table table-striped">
					<tr>
						<td width="120"><strong>
							Top-Lane
						</strong></td>
						<td>
                            <a href="/champions/{{ $match->team2topchampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team2topchampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team2topplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team2_top_player }}/{{ $match->team2topplayer->nickname }}" class="player_tooltip" rel="{{ 
                                $match->team2_top_player }}">{{ $match->team2topplayer->nickname }}</a>
                        </td>
					</tr>
                    <tr>
						<td width="120"><strong>
							Jungle
						</strong></td>
						<td>
                            <a href="/champions/{{ $match->team2junglechampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team2junglechampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team2jungleplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team2_jungle_player }}/{{ $match->team2jungleplayer->nickname }}" class="player_tooltip" rel="{{ 
                                $match->team2_jungle_player }}">{{ $match->team2jungleplayer->nickname }}</a>
                        </td>
					</tr>
                    <tr>
						<td width="120"><strong>
							Mid-Lane
						</strong></td>
						<td>
                            <a href="/champions/{{ $match->team2midchampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team2midchampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team2midplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team2_mid_player }}/{{ $match->team2midplayer->nickname }}" class="player_tooltip" rel="{{ 
                                $match->team2_mid_player }}">{{ $match->team2midplayer->nickname }}</a>
                        </td>
					</tr>
                    <tr>
						<td width="120"><strong>
							AD-Carry
						</strong></td>
						<td>
                            <a href="/champions/{{ $match->team2adcchampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team2adcchampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team2adcplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team2_adc_player }}/{{ $match->team2adcplayer->nickname }}" class="player_tooltip" rel="{{ 
                                $match->team2_adc_player }}">{{ $match->team2adcplayer->nickname }}</a>
                        </td>
					</tr>
                    <tr>
						<td width="120"><strong>
							Support
						</strong></td>
						<td>
                            <a href="/champions/{{ $match->team2supportchampion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $match->team2supportchampion->key }}.png" class="img-circle" width="20" /></a>&nbsp;&nbsp;<img src="/img/flags/{{ $match->team2supportplayer->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $match->team2_support_player }}/{{ $match->team2supportplayer->nickname }}" class="player_tooltip" rel="{{ 
                                $match->team2_support_player }}">{{ $match->team2supportplayer->nickname }}</a>
                        </td>
					</tr>
				</table>
			
		</td>
	</tr>
</table>
<br/>
<h2 class="headline_no_border">Mehr Informationen</h2>
<table class="table table-striped">
	@if($match->title != "")
	<tr>
		<td width="120"><strong>Ttiel</strong></td>
		<td>
			{{ $match->title }}
		</td>
	</tr>
	@endif
	<tr>
		<td width="120"><strong>Liga / Turnier</strong></td>
		<td><a href="/leagues/{{ $match->league->id }}/{{ $match->league->slug }}"><img src="/img/leagues/{{ $match->league->logo }}" height="20" />&nbsp;&nbsp;{{ $match->league->name }} - {{ date("d.m.Y - H:i",strtotime($match->game_date)) }} Uhr</a></td>
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
</div>
<br/>
@include("layouts.disqus")	
@stop