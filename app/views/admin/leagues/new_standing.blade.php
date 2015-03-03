@extends('layouts.admin')
@section('title', "Liga Platzierung erstellen")
@section('content')
	{{ Form::open(array('action' => 'AdminLeaguesController@create_standing')) }}
	<table class="table table-striped">
    <tr>
		<th>Liga ID</th>
		<th>Team ID</th>
		<th>Rang</th>
		<th>Letzter Rang</th>
		<th>Win</th>
		<th>Loss</th>
	</tr>
	<tr>
		<td>{{ Form::text('league_id', Input::old('league_id'),  array('class' => 'form-control')) }}</td>
		<td>{{ Form::text('team_id', Input::old('team_id'),  array('class' => 'form-control')) }}</td>
		<td>{{ Form::text('rank', Input::old('rank'),  array('class' => 'form-control')) }}</td>
		<td>{{ Form::text('last_rank', Input::old('last_rank'),  array('class' => 'form-control')) }}</td>
		<td>{{ Form::text('wins', Input::old('wins'),  array('class' => 'form-control')) }}</td>
		<td>{{ Form::text('loss', Input::old('loss'),  array('class' => 'form-control')) }}</td>
	</tr>
</table>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop