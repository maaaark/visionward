@extends('layouts.admin')
@section('title', "Featured Contents")
@section('content')
	
	<table class="table table-striped">
			<tr>
				<th>ID</th>
				<th>Image</th>
				<th>Headline</th>
				<th>Sortierung</th>
				<th>Erstellt</th>
				<th>Löschen</th>
			</tr>
		@foreach($featuredContents as $featuredContent)
			<tr>
				<td><a href="/admin/featuredContents/edit/{{ $featuredContent->id }}">{{ $featuredContent->id }}</a></td>
				<td><a href="/admin/featuredContents/edit/{{ $featuredContent->id }}"><img src="../uploads/featuredcontent/{{ $featuredContent->destination }}/{{ $featuredContent->filename }}" width="100" /></a></td>
				<td><a href="/admin/featuredContents/edit/{{ $featuredContent->id }}">{{ $featuredContent->headline }}</a></td>
				<td><a href="/admin/featuredContents/edit/{{ $featuredContent->id }}">{{ $featuredContent->order }}</a></td>
				<td>{{ $featuredContent->created_at }}</td>
				<td><a href="/admin/featuredContents/delete/{{ $featuredContent->id }}" class="delete">Löschen</a></td>
			</tr>
		@endforeach
	</table>
	<a href="/admin/featuredContents/create" class="btn btn-primary">Neues Bild hochladen</a>
	
@stop