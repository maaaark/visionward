@extends('layouts.admin')
@section('title', "News - ".$post->title)
@section('content')
	<!--{{ Form::open(array('action' => 'AdminPostsController@update')) }} -->
	{{ Form::model($post, ['action' => ['AdminPostsController@update'], 'method' => 'post', 'files' => 'true']) }}
	@include('admin.news.form')
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	<a href="/news/{{ $post->id }}" target="blank" class="btn btn-primary">Vorschau</a>
	{{ Form::close() }}
@stop