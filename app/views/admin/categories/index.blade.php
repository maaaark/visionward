@extends('layouts.admin')
@section('title', "Kategorien")
@section('content')
	
	<table class="table table-striped">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Slug</th>
				<th>Löschen</th>
			</tr>
		@foreach($categories as $category)
			<tr>
				<td><a href="/admin/categories/{{ $category->id }}">{{ $category->id }}</a></td>
				<td><a href="/admin/categories/{{ $category->id }}">{{ $category->name }}</a></td>
				<td><a href="/admin/categories/{{ $category->id }}">{{ $category->slug }}</a></td>
				<td><a href="/admin/categories/delete/{{ $category->id }}" class="">Löschen</a></td>
			</tr>
		@endforeach
	</table>
	<a href="/admin/categories/new" class="btn btn-primary">Neue Kategorie</a>
	
@stop