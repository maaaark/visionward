@extends('layouts.admin')
@section('title', "Kategorien - Neue Kategorie")
@section('content')
	{{ Form::open(array('action' => 'AdminCategoriesController@update', 'files' => 'true', 'method' => 'post')) }}	
	<input type="hidden" class="form-control" name="category_id" value="{{ $category->id }}" />
	<table class="table table-striped">
		<tr>
			<td width="200"><strong>Name</strong></td>
			<td><input type="text" class="form-control" name="name" value="{{ $category->name }}" placeholder="Kategorie Name" /></td>
		</tr>
		<tr>
			<td width="200"><strong>Slug</strong></td>
			<td><input type="text" class="form-control" name="slug" value="{{ $category->slug }}" placeholder="Kategorie Slug" /></td>
		</tr>
		<tr>
			<td width="200"><strong>Header Image</strong></td>
			<td>
				{{ Form::file('header_image') }}
				@if($category->header_image != "")
					<br/>
					<img src="/img/header/{{ $category->header_image }}" style="max-width: 700px;" />
				@endif
			</td>
		</tr>
	</table>
	{{ Form::submit('Speichern', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop