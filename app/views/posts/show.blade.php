@extends('layouts.no_header')
@section('title', "News / ".$post->title)
@section('content')

@if($post->published == 1)
	@include("posts.post")
@else
	@if(Auth::check())
		@if(Auth::user()->hasRole("admin") || Auth::user()->hasRole("mod"))
			<a href="/admin/news/edit/{{ $post->id }}">Unveröffentlicht</a>
			@include("posts.post")
		@else
			Du hast kein Zugriff auf diese Seite
		@endif
	@else
		Du hast kein Zugriff auf diese Seite
	@endif
@endif
	
@stop