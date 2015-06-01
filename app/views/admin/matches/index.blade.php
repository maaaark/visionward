@extends('layouts.admin')
@section('title', "Matches")
@section('content')
	
	
	<a href="/admin/matches/create" class="btn btn-primary">Neues Match erstellen</a>
	<table class="table table-striped" style="margin-top: 20px;">
			<tr>
				<th>Titel</th>
				<th>Spiel</th>
				<th>Spiel Datum</th>
				<th>Liga</th>
				<th>Löschen</th>
			</tr>
		@foreach($matches as $match)
			<tr>
				<td><a href="/admin/matches/{{ $match->id }}/edit">{{ $match->title }}</a></td>
				<td><a href="/admin/matches/{{ $match->id }}/edit">{{ $match->team->name }} vs. {{ $match->team2->name }}</a></td>
				<td><a href="/admin/matches/edit/{{ $match->id }}/edit">{{ $match->game_date }}</a></td>
				<td>{{ $match->league->name }}</td>
				<td>
					{{ Form::open(array('url' => 'admin/matches/' . $match->id, 'class' => '')) }}
						{{ Form::hidden('_method', 'DELETE') }}
						{{ Form::submit('löschen', array('class' => 'delete')) }}
					{{ Form::close() }}
					<!--<a href="/admin/match/{{ $match->id }}/delete" class="delete">Löschen</a>-->
				</td>
			</tr>
		@endforeach
	</table>
	<a href="/admin/matches/create" class="btn btn-primary">Neues Match erstellen</a>
	
@stop