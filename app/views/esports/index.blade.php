@extends('layouts.header_esports')
@section('title', "Esports")
@section('content')
<h1>Esports</h1>
	@if(isset($standings) AND $standings AND count($standings) > 0)
		<?php
			$col_size = floor(12 / count($standings));
		?>
		<div class="row">
			@foreach($standings as $standing)
				<div class="col-md-{{ trim($col_size) }}">
					<div class="standings_box">
						<div class="title">
							<img src="{{ $standing["league"]->league_image }}" class="league_icon">
							{{ $standing["league"]->label }} <span>> {{ $standing["tournament"]->name }}</span>
						</div>
						@if(isset($standing["standings"]) AND count($standing["standings"]) > 0)
							<table class="standings">
								<thead>
									<th colspan="3"></th>
									<th colspan="2">Spiele</th>
									<th>Punkte</th>
								</thead>
								<tbody>
								@foreach($standing["standings"] as $element)
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
			@endforeach
		</div>
	@endif

	@foreach($leagues as $league)
		<a href="/esports/{{ str_replace(" ", "_", trim(strtolower($league["short_name"]))) }}">{{ $league["label"] }}</a>
		<br/>
	@endforeach
@stop