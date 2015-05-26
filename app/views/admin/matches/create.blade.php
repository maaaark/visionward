@extends('layouts.admin')
@section('title', "Neues match")
@section('content')
	{{ Form::open(array('action' => 'AdminMatchesController@store' )) }}	
	@include('admin.matches.form')
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop