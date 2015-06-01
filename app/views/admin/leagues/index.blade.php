@extends('layouts.admin')
@section('title', "Platzierungen")
@section('content')
	
	<table class="table table-striped">
			<tr>
				<th>Liga</th>
				<th>Region</th>
                <th></th>
			</tr>
		@foreach($leagues as $league)
			<tr>
				<td><a href="/admin/leagues/{{ $league->id }}/edit">{{ $league->name }}</a></td>
				<td><a href="/admin/leagues/{{ $league->id }}/edit">{{ $league->region }}</a></td>
				<td>
					{{ Form::open(array('url' => 'admin/leagues/' . $league->id, 'class' => '')) }}
						{{ Form::hidden('_method', 'DELETE') }}
						{{ Form::submit('löschen', array('class' => 'delete')) }}
					{{ Form::close() }}
				</td>
			</tr>
		@endforeach
	</table>
	<a href="/admin/leagues/create" class="btn btn-primary">Neue Platzierung erstellen</a>
	
@stop