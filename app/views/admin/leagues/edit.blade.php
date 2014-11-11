@extends('layouts.admin')
@section('title', "Platzierung - ".$league->name)
@section('content')
	{{ Form::model($league, array('action' => array('AdminLeaguesController@update', $league->id), 'method' => 'PUT')) }}
	@include('admin.leagues.form')
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop