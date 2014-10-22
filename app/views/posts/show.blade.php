@extends('layouts.small_header')
@section('title', $post->title)
@section('subtitle', $post->created_at->diffForHumans()." - gepostet von ".$post->user->username)
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

	@if(Auth::check())
		@if(Auth::user()->hasRole("admin") || Auth::user()->hasRole("mod"))
			<a href="/admin/news/edit/{{ $post->id }}">News bearbeiten</a><br/><br/>
		@endif
	@endif
	
@stop