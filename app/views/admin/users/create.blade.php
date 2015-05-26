@extends('layouts.admin')
@section('title', "Neuer User")
@section('content')
	{{ Form::open(array('action' => 'AdminUsersController@save')) }}
	@include('admin.users.form')
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop