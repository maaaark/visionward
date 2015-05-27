@extends('layouts.admin')
@section('title', "User - ".$user->first_name)
@section('content')
	{{ Form::model($user, ['action' => ['AdminUsersController@update'], 'method' => 'post']) }}
	@include('admin.users.form')
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop