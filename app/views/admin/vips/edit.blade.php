@extends('layouts.admin')
@section('title', "VIP - ".$vip->nickname)
@section('content')
	{{ Form::model($vip, array('action' => array('AdminVipsController@update', $vip->id), 'method' => 'PUT')) }}
	@include('admin.vips.form')
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop