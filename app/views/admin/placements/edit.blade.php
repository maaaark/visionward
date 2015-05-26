@extends('layouts.admin')
@section('title', "Platzierung - ".$placement->team->name)
@section('content')
	{{ Form::model($placement, array('action' => array('AdminPlacementsController@update', $placement->id), 'method' => 'PUT')) }}
	@include('admin.placements.form')
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop