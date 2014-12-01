@extends('layouts.admin')
@section('title', "Neuer Artikel")
@section('content')
	{{ Form::open(array('action' => 'AdminArticlesController@store' )) }}	
	@include('admin.articles.form')
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop