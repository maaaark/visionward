@extends('layouts.admin')
@section('title', "Platzierungen")
@section('content')
	
	<table class="table table-striped">
			<tr>
				<th>Team</th>
				<th>Platz</th>
				<th>Liga</th>
                <th></th>
			</tr>
		@foreach($placements as $placement)
			<tr>
				<td><a href="/admin/placements/{{ $placement->id }}/edit">{{ $placement->team->name }}</a></td>
				<td><a href="/admin/placements/{{ $placement->id }}/edit">{{ $placement->place }}</a></td>
				<td><a href="/admin/placements/edit/{{ $placement->id }}/edit">{{ $placement->league->name }}</a></td>
				<td>
					{{ Form::open(array('url' => 'admin/placements/' . $placement->id, 'class' => '')) }}
						{{ Form::hidden('_method', 'DELETE') }}
						{{ Form::submit('löschen', array('class' => 'delete')) }}
					{{ Form::close() }}
				</td>
			</tr>
		@endforeach
	</table>
	<a href="/admin/placements/create" class="btn btn-primary">Neue Platzierung erstellen</a>
	
@stop