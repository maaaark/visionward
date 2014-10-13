@extends('layouts.master')
@section('header_image', $category->header_image)
@section('title', "Archiv / ".$category->name)
@section('content')

	<div class="headline">Archiv von "{{ $category->name }}"</div>
	<br/>
	@foreach($category->posts as $post)
		{{ $post->title }}<br/>
	@endforeach
	
@stop