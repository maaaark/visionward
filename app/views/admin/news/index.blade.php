@extends('layouts.admin')
@section('title', "News")
@section('content')
	
	<table class="table table-striped">
			<tr>
				<th>Titel</th>
				<th>User</th>
				<th>Erstellt</th>
				<th>Korrigiert</th>
				<th>Öffentlich</th>
			</tr>
		@foreach($posts as $post)
			<tr>
				<td><a href="/admin/news/{{ $post->id }}">{{ $post->title }}</a></td>
				<td><a href="/admin/news/{{ $post->id }}">{{ $post->user->first_name }}</a></td>
				<td>{{ $post->created_at }}</td>
				<td>{{ $post->corrected }}</td>
				<td>{{ $post->published }}</td>
			</tr>
		@endforeach
	</table>
	<a href="/admin/news/new" class="btn btn-primary">Neue News schreiben</a>
	
@stop