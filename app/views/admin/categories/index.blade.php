@extends('layouts.admin')
@section('title', "Kategorien")
@section('content')
	
	<table class="table table-striped">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>News</th>
				<th>Slug</th>
				<th>Löschen</th>
			</tr>
		@foreach($categories as $category)
			<tr>
				<td><a href="/admin/categories/edit/{{ $category->id }}">{{ $category->id }}</a></td>
				<td><a href="/admin/categories/edit/{{ $category->id }}">{{ $category->name }}</a></td>
				<td><a href="/admin/categories/edit/{{ $category->id }}">{{ $category->posts->count() }} News</a></td>
				<td><a href="/admin/categories/edit/{{ $category->id }}">{{ $category->slug }}</a></td>
				<td><a href="/admin/categories/delete/{{ $category->id }}" class="delete">Löschen</a></td>
			</tr>
		@endforeach
	</table>
	<a href="/admin/categories/new" class="btn btn-primary">Neue Kategorie</a>
	
@stop