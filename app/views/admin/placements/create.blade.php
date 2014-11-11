@extends('layouts.admin')
@section('title', "Neue Platzierung")
@section('content')
	{{ Form::open(array('action' => 'AdminPlacementsController@store' )) }}	
	@include('admin.placements.form')
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop