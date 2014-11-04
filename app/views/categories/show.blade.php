@extends('layouts.small_header')
@section('header_image', $category->header_image)
@section('title', "Archiv von ".$category->name)
@section('subtitle', $category->description)
@section('content')
	<div class="container-fluid">
		<ul class="news_list">
		@foreach($category->posts as $post)
			@if($post->published == 1)
				<li>
					<div class="news">
					  <div class="row">
					  <div class="col-md-3 hidden-xs hidden-sm"><a href="/news/{{ $post->id }}/{{ $post->slug }}"><img src="/uploads/news/{{ $post->image }}" width="100%" /></a></div>
					  <div class="col-md-9 text">
						<h2><a href="/news/{{ $post->id }}/{{ $post->slug }}">{{ $post->title }}</a></h2>
						{{ $post->excerpt }}
						<div class="meta">
							<span class="comments_count"><a href="/news/{{ $post->id }}/{{ $post->slug }}#disqus_thread">0 Kommentare</a></span> {{ $post->created_at->format('d.m.Y') }} - {{ $post->created_at->format('H:i') }} Uhr
						</div>
					  </div>
					  <div class="clear"></div>
					</div>
				</li>
			@endif
		@endforeach
		</ul>
	</div>
@stop