@extends('layouts.admin')
@section('title', "Neues Team")
@section('content')
	{{ Form::open(array('action' => 'AdminTeamsController@store', 'files'=>true )) }}	
	@include('admin.teams.form')
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop