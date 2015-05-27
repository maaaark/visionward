@extends('layouts.admin')
@section('title', "Champion - ".$counterpick->name)
@section('content')
	{{ Form::model($counterpick, array('action' => array('AdminCounterpicksController@update', $counterpick->id), 'method' => 'PUT')) }}
	@include('admin.counterpicks.form')
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop