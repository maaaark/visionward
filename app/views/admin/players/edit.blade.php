@extends('layouts.admin')
@section('title', "Spieler - ".$player->name)
@section('content')
	{{ Form::model($player, array('action' => array('AdminPlayersController@update', $player->id), 'method' => 'PUT', 'files' => 'true')) }}
	@include('admin.players.form')
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop