@extends('layouts.admin')
@section('title', "Galerie - ".$gallery->title)
@section('content')
	{{ Form::model($gallery, ['action' => ['AdminGalleriesController@update'], 'method' => 'post', 'files' => 'true']) }}
	@include('admin.galleries.form')
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop