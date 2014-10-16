@extends('layouts.admin')
@section('title', "Bild - ".$picture->title)
@section('content')
	{{ Form::model($picture, ['action' => ['AdminPicturesController@update'], 'method' => 'post', 'files' => 'true']) }}
	@include('admin.pictures.form')
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop