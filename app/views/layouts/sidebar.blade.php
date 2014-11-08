<?php
	$settingsArray = array(); 
?>
<div class="sidebar">
	@foreach($global_settings as $setting)
		<?php
			$settingsArray[$setting->key] = $setting->value;  
		?>
	@endforeach
			
	@if($settingsArray['stream_isactive'] === "1")
	<div class="block">
		<h2 class="headline">Livestream</h2>
		<div class="content">
		@if($settingsArray['stream_platform'] === "twitch")
			<iframe src="http://www.twitch.tv/{{$settingsArray['stream_name']}}/embed" frameborder="0" scrolling="no" width="360" height="220"></iframe>
		@elseif($settingsArray['stream_platform'] === "hitbox")
			<iframe width="360" height="203" src="http://hitbox.tv/#!/embed/{{$settingsArray['stream_name']}}" frameborder="0" allowfullscreen></iframe>
		@endif
		</div>
	</div>
	@endif
	
	<div class="block">
		<h2 class="headline">Featured Content</h2>
		<div class="content">
			<img src="/img/worlds.jpg" width="100%" />
		</div>
	</div>
	
	
	@if(!Request::is('/'))
	<div class="block">
		<h2 class="headline">Letzte News</h2>
		<div class="content">
			@foreach($global_last_posts as $post)
				<table class="last_news">
					<tr>
						<td valign="top" width="60">
							<a href="/news/{{ $post->id }}/{{ $post->slug }}"><img src="/uploads/news/{{ $post->image }}" width="50" /></a>
						</td>
						<td valign="top">
							<a href="/news/{{ $post->id }}/{{ $post->slug }}"><strong>{{ str_limit($post->title, $limit = 50, $end = '...') }}</strong></a><br/>
							<div class="post_meta">
								{{ $post->created_at->diffForHumans() }}
							</div>
						</td>
					</tr>
				</table>
			@endforeach
		</div>
	</div>
	@endif
	
	<div class="block">
		<h2 class="headline_no_border">Champions und Skins im Angebot</h2>
		<div class="content">
			<table>
				<tr>
					<td valign="top">
						<table class="table table-striped visionward_font">
							<tr>
								<th colspan="2">Champions</th>
							</tr>
						@foreach($global_champion_sales as $champion_sale)
							<tr>
								<td width="30"><a href="/champions/{{ $champion_sale->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $champion_sale->key }}.png" class="img-circle" width="30" /></a></td>
								<td width="150"><a href="/champions/{{ $champion_sale->key }}">{{ $champion_sale->name }}</a></td>
							</tr>
						@endforeach
						</table>
					</td>
					<td valign="top">
						<table class="table table-striped visionward_font">
							<tr>
								<th colspan="2">Skins</th>
							</tr>
						@foreach($global_skin_sales as $skin_sale)
							<tr>
								<td width="30"><a href="/champions/{{ $skin_sale->champion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $skin_sale->champion->key }}.png" class="img-circle" width="30" /></a></td>
								<td width="150"><a href="/champions/{{ $skin_sale->champion->key }}">{{ $skin_sale->name }}</a></td>
							</tr>
						@endforeach
						</table>
					</td>
				</tr>
			</table>

		</div>
	</div>
	
	
	<div class="block">
		<h2 class="headline_no_border">Ausstehende Spiele</h2>
		<div class="content">
			<table class="table table-striped visionward_font">
			@foreach($global_matches as $match)
				<tr>
					<td width="170"><a href="/matches/{{ $match->id }}"><img src="/img/teams/logos/{{ $match->team->logo }}" height="20" />&nbsp;&nbsp;{{ $match->team->name }}</a></td>
					<td width="20"><a href="/matches/{{ $match->id }}">vs.</a></td>
					<td width="170"><a href="/matches/{{ $match->id }}"><img src="/img/teams/logos/{{ $match->team2->logo }}" height="20" />&nbsp;&nbsp;{{ $match->team2->name }}</a></td>
				</tr>
			@endforeach
				<tr>
					<td colspan="3" style="text-align: right;"><a href="/matches" class="red">Zeige alle Spiele</a></td>
				</tr>
			</table>
		</div>
	</div>
	
	
	<div class="block">
		<h2 class="headline_no_border">Spieler Transfers</h2>
		<div class="content">
			<table class="table table-striped visionward_font">
			@foreach($global_transfers as $transfer)
				<tr>
					<td width="120"><a href="/players/{{ $transfer->player->id }}/{{ $transfer->player->nickname }}">{{ $transfer->player->nickname }}</a></td>
					<td width="120" class="old_team"><a href="/teams/{{ $transfer->oldteam->id }}/{{ $transfer->oldteam->slug }}"><img src="/img/teams/logos/{{ $transfer->oldteam->logo }}" height="20" /><span class="hidden-xs hidden-sm">&nbsp;&nbsp;{{ str_limit($transfer->oldteam->name, $limit = 10, $end = '...') }}</span></td>
					<td class="new_team" width="120"><a href="/teams/{{ $transfer->team->id }}/{{ $transfer->team->slug }}"><img src="/img/teams/logos/{{ $transfer->team->logo }}" height="20" /><span class="hidden-xs hidden-sm">&nbsp;&nbsp;{{ str_limit($transfer->team->name, $limit = 10, $end = '...') }}</span></a></td>
				</tr>
			@endforeach
				<tr>
					<td colspan="3" style="text-align: right;"><a href="/transferlist" class="red">Zeige alle Wechsel</a></td>
				</tr>
			</table>
		</div>
	</div>
	
</div>