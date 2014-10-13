@extends('layouts.master')
@section('title', "League of Legends News und eSport Coverage")
@section('content')
	<div class="container-fluid">
	<ul class="news_list">
		<?php $i=1; $x=1; ?>
		@foreach($posts as $post)
			<li>
				@if($i<=2)
					
						<div class="news">
						  <div class="row">
						  <div class="col-md-3 hidden-xs hidden-sm"><a href="/news/{{ $post->id }}"><img src="/img/news.jpg"/></a></div>
						  <div class="col-md-9 text">
							<h2><a href="/news/{{ $post->id }}">{{ $post->title }}</a></h2>
							Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
							<div class="meta">
								<span class="comments_count"><a href="/news/{{ $post->id }}#disqus_thread">0 Kommentare</a></span> {{ $post->created_at->format('d.m.Y') }} - {{ $post->created_at->format('H:i') }} Uhr
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
								<td width="40"><a href="/news/{{ $post->id }}"><img src="/img/league_icon.jpg" style="margin-left: 10px;" /></a></td>
								<td width="90"><span class="meta">{{ $post->created_at->diffForHumans() }}&nbsp;&nbsp;</span></td>
								<td width="80"><span class="comments_count"><a href="/news/{{ $post->id }}#disqus_thread">0 Kommentare</a></span></td>
								<td><a class="small_headline" href="/news/{{ $post->id }}">{{ $post->title }}</a></td>
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