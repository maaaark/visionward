@extends('layouts.admin')
@section('title', "Neue Spieler")
@section('content')
	{{ Form::open(array('action' => 'AdminPlayersController@store' )) }}	
	@include('admin.players.form')
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop