@extends('layouts.admin')
@section('title', "Neue Platzierung")
@section('content')
	{{ Form::open(array('action' => 'AdminLeaguesController@store' )) }}	
	@include('admin.leagues.form')
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop