@extends('layouts.small_header')
@section('title', $article->title)
@section('subtitle', "<a href='/users/".$article->user->id."'>".$article->created_at->diffForHumans()." - gepostet von ".$article->user->username."</a>")
@section('content')
	
	@if(Auth::check())
		@if(Auth::user()->hasRole("admin") || Auth::user()->hasRole("mod"))
			<a href="/admin/news/edit/{{ $article->id }}">News bearbeiten</a><br/><br/>
		@endif
	@endif
	
@if($article->published == 1)
	@include("articles.post")
	@if($article->gallery)
		@include("posts.gallery")
	@endif	
@else
	@if(Auth::check())
		@if(Auth::user()->hasRole("admin") || Auth::user()->hasRole("mod"))
			<a href="/admin/news/edit/{{ $article->id }}">Unveröffentlicht</a>
			@include("articles.post")
		@else
			Du hast kein Zugriff auf diese Seite
		@endif
	@else
		Du hast kein Zugriff auf diese Seite
	@endif
@endif

	@if(Auth::check())
		@if(Auth::user()->hasRole("admin") || Auth::user()->hasRole("mod"))
			<a href="/admin/news/edit/{{ $article->id }}">News bearbeiten</a><br/><br/>
		@endif
	@endif
	
@stop