<?php //var_dump($featuredContents);die("qwe"); ?>
@extends('layouts.admin')
@section('title', "Bild - ".$featuredContents->headline)
@section('content')
	{{ Form::model($featuredContents, ['action' => ['AdminFeaturedContentsController@update'], 'method' => 'post', 'files' => 'true']) }}
	@include('admin.featuredContents.form')
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop