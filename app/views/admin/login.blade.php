@extends('layouts.small_header')
@section('title', "Admin Login")
@section('content')

{{ Form::open(array('url' => '/login')) }}
	<p>
		{{ $errors->first('email') }}
		{{ $errors->first('password') }}
	</p>
	
	
	<div class="input-group">
	  <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
	  {{ Form::text('email', Input::old('email'), array('placeholder' => 'example@lolquest.net', 'class' => 'form-control')) }}
	</div>
	<br/>
	<div class="input-group">
	  <span class="input-group-addon"><i class="fa fa-key"></i></span>
	  {{ Form::password('password', array('class' => 'form-control')) }}
	</div>
	<br/>
	<p>{{ Form::submit('Submit!', array('class' => 'btn btn-primary btn-block')) }}</p>
{{ Form::close() }}


@stop