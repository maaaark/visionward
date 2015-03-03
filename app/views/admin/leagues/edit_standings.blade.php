@extends('layouts.admin')
@section('title', "Liga Platzierung bearbeiten")
@section('content')
	{{ Form::model($standing, array('action' => array('AdminLeaguesController@update_standing', $standing->id), 'method' => 'POST')) }}
	<table class="table table-striped">
    <tr>
		<th>Name</th>
		<th>Rang</th>
		<th>Letzter Rang</th>
		<th>Win</th>
		<th>Loss</th>
	</tr>
	<tr>
		<td width="200"><strong>{{ $standing->team->name }}</strong></td>
		<td>{{ Form::text('rank', Input::old('rank'),  array('class' => 'form-control')) }}</td>
		<td>{{ Form::text('last_rank', Input::old('last_rank'),  array('class' => 'form-control')) }}</td>
		<td>{{ Form::text('wins', Input::old('wins'),  array('class' => 'form-control')) }}</td>
		<td>{{ Form::text('loss', Input::old('loss'),  array('class' => 'form-control')) }}</td>
	</tr>
</table>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop