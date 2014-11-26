@extends('layouts.admin')
@section('title', "Neues Slider-Bild")
@section('content')
	{{ Form::open(array('action' => 'AdminSlidersController@save', 'files'=>true )) }}	
	@include('admin.sliders.form')
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop