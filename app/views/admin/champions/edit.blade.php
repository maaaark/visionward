@extends('layouts.admin')
@section('title', "Champion - ".$champion->name)
@section('content')
	{{ Form::model($champion, array('action' => array('AdminChampionsController@update', $champion->id), 'method' => 'PUT')) }}
	@include('admin.champions.form')
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop