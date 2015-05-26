@extends('layouts.admin')
@section('title', "Neues Bild")
@section('content')
	{{ Form::open(array('action' => 'AdminPicturesController@save', 'files'=>true )) }}	
	@include('admin.pictures.form')
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop