@extends('layouts.admin')
@section('title', "Team - ".$team->name)
@section('content')
	{{ Form::model($team, array('action' => array('AdminTeamsController@update', $team->id), 'method' => 'PUT', 'files' => 'true')) }}
	@include('admin.teams.form')
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop