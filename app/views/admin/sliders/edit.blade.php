@extends('layouts.admin')
@section('title', "Bild - ".$slider->title)
@section('content')
	{{ Form::model($slider, ['action' => ['AdminSlidersController@update'], 'method' => 'post', 'files' => 'true']) }}
	@include('admin.sliders.form')
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop