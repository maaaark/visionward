@extends('layouts.admin')
@section('title', "Artikel - ".$article->title)
@section('content')
	<!--{{ Form::open(array('action' => 'AdminPostsController@update')) }} -->
	{{ Form::model($post, ['action' => ['AdminPostsController@update'], 'method' => 'post', 'files' => 'true']) }}
	@include('admin.articles.form')
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	<a href="/articles/{{ $article->id }}/{{ $article->slug }}" target="blank" class="btn btn-primary">Vorschau</a>
	{{ Form::close() }}
@stop