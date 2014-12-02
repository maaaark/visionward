@extends('layouts.master')
@section('title', "League of Legends News und eSport Coverage")
@section('content')
	
	<h2 class="headline">Aktuelle League of Legends News</h2>
	<ul class="news_list">
		<?php 
		
			$i=1;
			$x=1;
		
		?>
			@foreach($posts as $post)
				<li>
					<div class="row">
						<div class="col-md-12">
						@if($x == 1)
							<?php $class="grey"; $x=0; ?>
						@else
							<?php $class=""; $x=1; ?>
						@endif
						<table class="news_small">
							<tr class="{{ $class }}">
								<td width="40"><a href="/news/{{ $post->id }}/{{ $post->slug }}"><img src="<?=Croppa::url('/uploads/news/'.$post->image, 50, null)?>" style="margin-left: 10px;margin-right: 10px;" /></a></td>
								<td width="90"><span class="meta">{{ Helpers::diffForHumans($post->created_at) }}&nbsp;&nbsp;</span></td>
								<td width="80"><span class="comments_count"><a href="/news/{{ $post->id }}/{{ $post->slug }}#disqus_thread">0 Kommentare</a></span></td>
								<td><a class="small_headline" href="/news/{{ $post->id }}/{{ $post->slug }}">{{ $post->title }}</a></td>
							</tr>
						</table>
						</div>
					</div>
				</li>
			@endforeach
	</ul>
	{{ $posts->links() }}
@stop