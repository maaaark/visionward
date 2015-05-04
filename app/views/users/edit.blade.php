@extends('layouts.small_header')
@section('title', "User - ".$user->first_name)
@section('content')
    {{ Form::model($user, ['action' => ['UsersController@update'], 'method' => 'post']) }}
    @include('users.form')
    <br/>
    {{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
@stop