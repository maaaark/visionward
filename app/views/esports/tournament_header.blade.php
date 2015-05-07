<div class="esports_opener_navi">
	<div class="holder">
		<a href="/esports/{{ str_replace(" ", "_", trim(strtolower($league->short_name))) }}">
			<div class="league_icon" style="background-image: url({{ $league->league_image }});"></div>
		</a>
		<div class="league_name">
			{{ $league->label }}
			@if(isset($tournament) AND isset($tournament->name))
				<div class="tournament_name">{{ $tournament->name }}</div>
			@endif
		</div>

		@if(isset($league_tournaments) AND count($league_tournaments) > 1 AND !isset($dont_show_tournaments_dropdown))
			<div class="tournaments_dropdown" id="league_tournaments_dropdown">
				<div class="current">{{ $tournament->name }}</div>

				<?php $count = 0; ?>
				@foreach($league_tournaments as $tournament_temp)
					@if($count <= 6 AND $tournament_temp->season == Helpers::getCurrentSeason())
						<?php $count++; ?>
						<a href="/esports/{{ str_replace(" ", "_", trim(strtolower($league->short_name))) }}/tournament/{{ $tournament_temp->tournament_id }}">
						@if($tournament->id == $tournament_temp->id)
						<div class="drop_element active">
						@else
						<div class="drop_element">
						@endif
							{{ $tournament_temp->name }}
						</div>
						</a>
					@endif
				@endforeach

				{{-- Wenn weniger als 6 Turniere der aktuellen Saison angezeigt wurden --}}
				@if($count == 0)
					@foreach($league_tournaments as $tournament_temp)
						@if($count <= 6)
							<?php $count++; ?>
							<a href="/esports/{{ str_replace(" ", "_", trim(strtolower($league->short_name))) }}/tournament/{{ $tournament_temp->tournament_id }}">
							@if($tournament->id == $tournament_temp->id)
							<div class="drop_element active">
							@else
							<div class="drop_element">
							@endif
								{{ $tournament_temp->name }}
							</div>
							</a>
						@endif
					@endforeach
				@endif
			</div>
			<script>
				$(document).ready(function(){
					$("#league_tournaments_dropdown").hover(
						function(){
							$(this).find(".drop_element").show();
						},
						function(){
							$(this).find(".drop_element").hide();
						}
					);
				});
			</script>
		@endif

		<div class="esports_header_navi">
			@yield('esports_navi_elements')
		</div>
	</div>
</div>