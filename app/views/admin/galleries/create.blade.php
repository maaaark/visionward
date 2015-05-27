@extends('layouts.admin')
@section('title', "Neue Galerie")
@section('content')
	{{ Form::open(array('action' => 'AdminGalleriesController@save')) }}
	@include('admin.galleries.form')
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop