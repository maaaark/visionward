@extends('layouts.admin')
@section('title', "Neue VIP")
@section('content')
	{{ Form::open(array('action' => 'AdminVipsController@store' )) }}	
	@include('admin.vips.form')
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop