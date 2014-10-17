@extends('layouts.admin')
@section('title', "Spieler")
@section('content')
	
	<table class="table table-striped">
			<tr>
				<th>Name</th>
				<th>Team</th>
				<th>Rolle</th>
				<th>Land</th>
				<th>Löschen</th>
			</tr>
		@foreach($players as $player)
			<tr>
				<td><a href="/admin/players/{{ $player->id }}/edit">{{ $player->name }}</a></td>
				<td><a href="/admin/players/{{ $player->id }}/edit">{{ $player->team->name }}</a></td>
				<td><a href="/admin/players/edit/{{ $player->id }}/edit">{{ $player->role }}</a></td>
				<td><a href="/admin/players/edit/{{ $player->id }}/edit">{{ $player->country }}</a></td>
				<td>
					{{ Form::open(array('url' => 'admin/players/' . $player->id, 'class' => '')) }}
						{{ Form::hidden('_method', 'DELETE') }}
						{{ Form::submit('löschen', array('class' => 'delete')) }}
					{{ Form::close() }}
				</td>
			</tr>
		@endforeach
	</table>
	<a href="/admin/players/create" class="btn btn-primary">Neuen Spieler erstellen</a>
	
@stop