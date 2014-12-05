@extends('layouts.small_header')
@section('title', $post->title)
@section('subtitle', "<a href='/users/".$post->user->id."'>".Helpers::diffForHumans($post->created_at)." - gepostet von ".$post->user->username."</a>")
@section('content')
	
	@if(Auth::check())
		@if(Auth::user()->hasRole("admin") || Auth::user()->hasRole("mod"))
			<a href="/admin/news/edit/{{ $post->id }}">News bearbeiten</a><br/><br/>
		@endif
	@endif
	
@if($post->published == 1)
	@include("posts.post")
	@if($post->gallery)
		@include("posts.gallery")
	@endif	
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