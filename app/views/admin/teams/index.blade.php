@extends('layouts.admin')
@section('title', "Teams")
@section('content')
	
	<table class="table table-striped">
			<tr>
				<th>Name</th>
				<th>Region</th>
				<th>Löschen</th>
			</tr>
		@foreach($teams as $team)
			<tr>
				<td><a href="/admin/teams/{{ $team->id }}/edit">{{ $team->name }}</a></td>
				<td><a href="/admin/teams/{{ $team->id }}/edit">{{ $team->region }}</a></td>
				<td>
					{{ Form::open(array('url' => 'admin/teams/' . $team->id, 'class' => '')) }}
						{{ Form::hidden('_method', 'DELETE') }}
						{{ Form::submit('Löschen', array('class' => 'delete')) }}
					{{ Form::close() }}
				</td>
			</tr>
		@endforeach
	</table>
	<a href="/admin/teams/create" class="btn btn-primary">Neues Team erstellen</a>
	
@stop