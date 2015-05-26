@extends('layouts.admin')
@section('title', "Pictures")
@section('content')
	<a href="/admin/pictures/create" class="btn btn-primary">Neues Bild hochladen</a><br/>
	<br/>
	<table class="table table-striped">
			<tr>
				<th>ID</th>
				<th>Image</th>
				<th>Galerie</th>
				<th>Erstellt</th>
				<th>Löschen</th>
			</tr>
		@foreach($pictures as $picture)
			<tr>
				<td><a href="/admin/pictures/edit/{{ $picture->id }}">{{ $picture->id }}</a></td>
				<td><a href="/admin/pictures/edit/{{ $picture->id }}">{{ $picture->filename }}</a></td>
				@if($picture->gallery_id != 0)
				<td><a href="/admin/pictures/edit/{{ $picture->id }}">{{ $picture->gallery->title }}</a></td>
				@else
				<td><a href="/admin/pictures/edit/{{ $picture->id }}">-</a></td>
				@endif
				<td>{{ $picture->created_at }}</td>
				<td><a href="/admin/pictures/delete/{{ $picture->id }}" class="delete">Löschen</a></td>
			</tr>
		@endforeach
	</table>
	<a href="/admin/pictures/create" class="btn btn-primary">Neues Bild hochladen</a>
	
@stop