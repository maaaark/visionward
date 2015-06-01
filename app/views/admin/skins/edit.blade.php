@extends('layouts.admin')
@section('title', "Skin - ".$skin->name)
@section('content')
	{{ Form::model($skin, array('action' => array('AdminSkinsController@update', $skin->id), 'method' => 'PUT')) }}
	@include('admin.skins.form')
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop