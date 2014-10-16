@extends('layouts.admin')
@section('title', "Gallerien")
@section('content')
	
	<table class="table table-striped">
			<tr>
				<th>ID</th>
				<th>Titel</th>
				<th>Beschreibung</th>
				<th>Bilder</th>
				<th>Erstellt</th>
				<th>Löschen</th>
			</tr>
		@foreach($galleries as $gallery)
			<tr>
				<td><a href="/admin/galleries/edit/{{ $gallery->id }}">{{ $gallery->id }}</a></td>
				<td><a href="/admin/galleries/edit/{{ $gallery->id }}">{{ $gallery->title }}</a></td>
				<td><a href="/admin/galleries/edit/{{ $gallery->id }}">{{ $gallery->description }}</a></td>
				<td><a href="/admin/galleries/edit/{{ $gallery->id }}">{{ $gallery->pictures->count() }} Bilder</a></td>
				<td>{{ $gallery->created_at }}</td>
				<td><a href="/admin/galleries/delete/{{ $gallery->id }}" class="delete">Löschen</a></td>
			</tr>
		@endforeach
	</table>
	<a href="/admin/galleries/create" class="btn btn-primary">Neue Galerie anlegen</a>
	
@stop