@extends('layouts.master')
@section('header_image', $category->header_image)
@section('title', "Archiv / ".$category->name)
@section('content')
	<div class="container-fluid">
	<div class="headline">Archiv von "{{ $category->name }}"</div>
		<ul class="news_list">
		@foreach($category->posts as $post)
			@if($post->published == 1)
				<li>
					<div class="news">
					  <div class="row">
					  <div class="col-md-3 hidden-xs hidden-sm"><a href="/news/{{ $post->id }}"><img src="/img/news.jpg"/></a></div>
					  <div class="col-md-9 text">
						<h2><a href="/news/{{ $post->id }}">{{ $post->title }}</a></h2>
						{{ $post->excerpt }}
						<div class="meta">
							<span class="comments_count"><a href="/news/{{ $post->id }}#disqus_thread">0 Kommentare</a></span> {{ $post->created_at->format('d.m.Y') }} - {{ $post->created_at->format('H:i') }} Uhr
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