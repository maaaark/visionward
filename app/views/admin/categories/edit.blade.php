@extends('layouts.admin')
@section('title', "Kategorien - Neue Kategorie")
@section('content')
	{{ Form::open(array('action' => 'AdminCategoriesController@update')) }}	
	<input type="hidden" class="form-control" name="category_id" value="{{ $category->id }}" />
	<table class="table table-striped">
		<tr>
			<td>Name</td>
			<td><input type="text" class="form-control" name="name" value="{{ $category->name }}" placeholder="Kategorie Name" /></td>
		</tr>
		<tr>
			<td>Slug</td>
			<td><input type="text" class="form-control" name="slug" value="{{ $category->slug }}" placeholder="Kategorie Slug" /></td>
		</tr>
	</table>
	{{ Form::submit('Speichern', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop