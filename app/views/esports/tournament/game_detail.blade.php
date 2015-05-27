@if($game->winner > 0)
	<div class="game_element" data-gamecount="{{ $game_count }}" id="game_element_{{ $game_count }}">
	@for($i = 100; $i <= 200; $i = $i + 100)
			@if($i == 100)
				@if(isset($game->youtube_video) AND trim($game->youtube_video) != "")
					<div class="youtube_video">
						<button class="esports_button" data-youtube="{{ $game->youtube_video }}" id="youtube_watch_btn">Spiel Aufnahme ansehen</button>
						<script>
							var youtube_key = "";
							function get_youtube_key(url) {
								var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
								return (url.match(p)) ? RegExp.$1 : false;
							}
							$("#youtube_watch_btn").click(function(){
								youtube_url = $(this).attr("data-youtube");
								if(youtube_key == ""){
									youtube_key = get_youtube_key(youtube_url);
								}
								html  = '<h1 class="site_title">{{ $team1->name }} gegen {{ $team2->name }}</h1>';
								html += '<iframe width="853" height="480" src="https://www.youtube.com/embed/'+youtube_key.trim()+'" frameborder="0" allowfullscreen></iframe>';
								showLightbox(html, null, "885px");
							});
						</script>
					</div>
				@endif
				<div class="team_name">
					<img class="team_icon" src="{{ $team1->logo_riot }}">
					<div class="info">
						{{ $team1->name }}
						@if($game->winner > 0)
							@if($game->winner == $team1->team_id)
								<div class="winner win esports_spoiler">Gewinner dieses Spiels</div>
							@else
								<div class="winner loss esports_spoiler">Verlierer dieses Spiels</div>
							@endif
						@else
							<div class="winner">Gewinner noch nicht bekannt</div>
						@endif
					</div>
					<div style="clear:both;"></div>
				</div>
			@else
				<div class="team_name">
					<img class="team_icon" src="{{ $team2->logo_riot }}">
					<div class="info">
						{{ $team2->name }}
						@if($game->winner > 0)
							@if($game->winner == $team2->team_id)
								<div class="winner win esports_spoiler">Gewinner dieses Spiels</div>
							@else
								<div class="winner loss esports_spoiler">Verlierer dieses Spiels</div>
							@endif
						@else
							<div class="winner">Gewinner noch nicht bekannt</div>
						@endif
					</div>
					<div style="clear:both;"></div>
				</div>
			@endif

			@if(isset($player) AND count($player) > 0)
				<table class="game_table">
					<thead>
						<th>Spieler</th>
						<th>Champion</th>
						<th>K/D/A</th>
						<th>Items</th>
						<th>Spells</th>
						<th>Gold</th>
						<th>Lasthits</th>
					</thead>
					<tbody>
					@foreach($player as $current_player)
						<?php $show_status = false; ?>
						@if($i == 100 AND $current_player["teamId"] == $game->blueteam_id)
							<?php $show_status = true; ?>
						@elseif($i == 200 AND $current_player["teamId"] == $game->redteam_id)
							<?php $show_status = true; ?>
						@endif

						@if($show_status)
							<tr class="player_tr">
								<td class="player">
									<div style="background-image: url({{ $current_player["photoURL"] }})" class="player_image"></div>
									<div class="player_name">
										{{ $current_player["name"] }}
										<div class="lane_info">Top-Lane</div>
									</div>
								</td>
								<td class="champion">
									<?php $champ = Helpers::getChampionById($current_player["championId"]); ?>
									<img class="champion_icon" src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ trim($champ["key"]) }}.png">
									<div class="level_info">Level: {{ $current_player["endLevel"] }}</div>
								</td>
								<td class="kda">
									{{ $current_player["kills"] }} / {{ $current_player["deaths"] }} / {{ $current_player["assists"] }}
								</td>
								<td class="items">
									<div>
									@for($item = 0; $item < 6; $item++)
										@if(isset($current_player["items".$item]) AND $current_player["items".$item] > 0)
											<img class="item_icon" src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/item/{{ $current_player["items".$item] }}.png">
										@else
											<!--<div class="item_icon no_icon"></div>-->
										@endif
									@endfor
									</div>
								</td>
								<td class="spells">
									<img class="spell_icon" src="/img/spells/{{ $current_player["spell0"] }}.png">
									<img class="spell_icon" src="/img/spells/{{ $current_player["spell1"] }}.png">
								</td>
								<td class="gold">
									{{ number_format($current_player["totalGold"], 0, ",", ".") }}
								</td>
								<td class="lasthits">
									{{ number_format($current_player["minionsKilled"], 0, ",", ".") }}
								</td>
							</tr>
						@endif
					@endforeach
					</tbody>
				</table>
			@else

			@endif
		@endfor
	</div>
@else
	<div class="game_not_played_yet">
		Es sind noch keine weiteren Informationen über dieses Spiel bekannt.
	</div>
@endif