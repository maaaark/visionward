<div class="sidebar">
	
	@if(!Request::is('/'))
	<div class="block">
		<div class="headline">Letzte News</div>
		<div class="content">
			@foreach($last_posts as $post)
				<table class="last_news">
					<tr>
						<td valign="top" width="60">
							<a href="/news/{{ $post->id }}/{{ $post->slug }}"><img src="/uploads/news/{{ $post->image }}" width="50" /></a>
						</td>
						<td valign="top">
							<a href="/news/{{ $post->id }}/{{ $post->slug }}"><strong>{{ $post->title }}</strong></a><br/>
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
		<div class="headline">Ausstehende Spiele</div>
		<div class="content">
			@foreach($matches as $match)
				{{ $match->team->name }} vs. {{ $match->team2->name }}<br/>
			@endforeach
		</div>
	</div>
	
	
	<div class="block">
		<div class="headline">Spieler Transfers</div>
		<div class="content">
			<table class="table table-striped">
			@foreach($transfers as $transfer)
				<tr>
					<td><a href="/players/{{ $transfer->player->id }}/{{ $transfer->player->nickname }}">{{ $transfer->player->nickname }}</a></td>
					<td class="old_team"><a href="/teams/{{ $transfer->oldteam->id }}/{{ $transfer->oldteam->name }}"><img src="/img/teams/logos/{{ $transfer->oldteam->logo }}" height="20" />&nbsp;&nbsp;{{ $transfer->oldteam->name }}</td>
					<td class="new_team"><a href="/teams/{{ $transfer->team->id }}/{{ $transfer->team->name }}"><img src="/img/teams/logos/{{ $transfer->team->logo }}" height="20" />&nbsp;&nbsp;{{ $transfer->team->name }}</a></td>
				</tr>
			@endforeach
			</table>
		</div>
	</div>
	
</div>