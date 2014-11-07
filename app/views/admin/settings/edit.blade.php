@extends('layouts.admin')
@section('title', "Settings")
@section('content')
	{{ Form::model($settings, ['action' => ['AdminSettingsController@update'], 'method' => 'post']) }}
	@include('admin.settings.form')
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop