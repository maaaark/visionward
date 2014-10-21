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
		<div class="headline">SIDEBAR HEADLINE</div>
		<div class="content">
			CONTENT
		</div>
	</div>
	
</div>