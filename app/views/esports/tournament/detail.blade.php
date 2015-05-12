@extends('layouts.header_esports')
@section('title', "Esports")
@section('esports_navi_elements')
		@include('esports.tournament.navi')
@stop
@section('opener')
	@include('esports.tournament_header')
@stop
@section('content')
	<script>$(".esports_opener_navi .esports_header_navi .element.overview").addClass("active");</script>
	<h1>Übersicht</h1>

	<div class="row">
		<div class="col-md-6">
			<div class="standings_box">
				<div class="title">
					<img src="{{ $league->league_image }}" class="league_icon">
					Tabelle
				</div>
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
					<div class="padding: 25px; color: rgba(0,0,0,0.6); text-align: center;">
						Es ist noch keine Tabelle vorhanden.
					</div>
				@endif
			</div>
		</div>
	</div>
@stop