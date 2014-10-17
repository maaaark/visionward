@extends('layouts.admin')
@section('title', "Match - ".$match->title)
@section('content')
	{{ Form::model($match, array('action' => array('AdminMatchesController@update', $match->id), 'method' => 'PUT')) }}
	@include('admin.matches.form')
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop