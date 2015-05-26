@extends('layouts.admin')
@section('title', "Neues Slider-Bild")
@section('content')
	{{ Form::open(array('action' => 'AdminFeaturedContentsController@save', 'files'=>true )) }}	
	@include('admin.featuredContents.form')
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop