@extends('layouts.admin')
@section('title', "News")
@section('content')
	
	<table class="table table-striped">
			<tr>
				<th>Titel</th>
				<th>User</th>
				<th>Erstellt</th>
				<td>Status</td>
				<th>Korrigiert</th>
				<th>Öffentlich</th>
				<th>Löschen</th>
			</tr>
		@foreach($posts as $post)
			@if($post->published == 1 && $post->corrected == 0)
			<tr class="warning">
			@elseif($post->published == 1)
			<tr class="success">
			@elseif($post->corrected == 1)
			<tr class="info">
			@else
			<tr>
			@endif
				<td><a href="/admin/news/edit/{{ $post->id }}">{{ $post->title }}</a></td>
				<td><a href="/admin/news/edit/{{ $post->id }}">{{ $post->user->first_name }}</a></td>
				<td>{{ $post->created_at }}</td>
				<td>
					@if($post->published == 1)
						Veröffentlicht
					@elseif($post->corrected == 1)
						Korrigiert
					@else
						Warte auf Korrektur
					@endif
				</td>
				<td>{{ $post->corrected }}</td>
				<td>{{ $post->published }}</td>
				<td><a href="/admin/news/delete/{{ $post->id }}" class="delete">Löschen</a></td>
			</tr>
		@endforeach
	</table>
	<a href="/admin/news/create" class="btn btn-primary">Neue News schreiben</a>
	
@stop