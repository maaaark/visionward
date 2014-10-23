@extends('layouts.master')
@section('title', "League of Legends News und eSport Coverage")
@section('content')
	<div class="container-fluid">
	<h2 class="headline">Aktuelle League of Legends News</h2>
	<ul class="news_list">
		<?php $i=1; $x=1; ?>
		@foreach($posts as $post)
			<li>
				@if($i<=3)
					
						<div class="news">
						  <div class="row">
						  <div class="col-md-3 hidden-xs"><a href="/news/{{ $post->id }}/{{ $post->slug }}"><img src="/uploads/news/{{ $post->image }}" width="170" /></a></div>
						  <div class="col-md-9 text">
							<h2><a href="/news/{{ $post->id }}/{{ $post->slug }}">{{ $post->title }}</a></h2>
							{{ $post->excerpt }}
							<div class="meta">
								<span class="comments_count"><a href="/news/{{ $post->id }}/{{ $post->slug }}#disqus_thread">0 Kommentare</a></span> {{ $post->created_at->format('d.m.Y') }} - {{ $post->created_at->format('H:i') }} Uhr
							</div>
						  </div>
						  <div class="clear"></div>
						</div>
					</div>
				@else
					<div class="row">
						<div class="col-md-12">
						@if($x == 1)
							<?php $class="grey"; $x=0; ?>
						@else
							<?php $class=""; $x=1; ?>
						@endif
						<table class="news_small">
							<tr class="{{ $class }}">
								<td width="40"><a href="/news/{{ $post->id }}/{{ $post->slug }}"><img src="/img/league_icon.jpg" style="margin-left: 10px;" /></a></td>
								<td width="90"><span class="meta">{{ $post->created_at->diffForHumans() }}&nbsp;&nbsp;</span></td>
								<td width="80"><span class="comments_count"><a href="/news/{{ $post->id }}/{{ $post->slug }}#disqus_thread">0 Kommentare</a></span></td>
								<td><a class="small_headline" href="/news/{{ $post->id }}/{{ $post->slug }}">{{ $post->title }}</a></td>
							</tr>
						</table>
						</div>
					</div>
				@endif
			</li>
			
			<?php $i++; ?>
		@endforeach
	</ul>
	</div>
@stop