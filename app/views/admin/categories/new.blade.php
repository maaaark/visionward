@extends('layouts.admin')
@section('title', "Kategorien - Neue Kategorie")
@section('content')
	{{ Form::open(array('action' => 'AdminCategoriesController@save')) }}	
	<table class="table table-striped">
		<tr>
			<td>Name</td>
			<td><input type="text" class="form-control" name="name" value="" placeholder="Kategorie Name" /></td>
		</tr>
		<tr>
			<td>Slug</td>
			<td><input type="text" class="form-control" name="slug" value="" placeholder="Kategorie Slug" /></td>
		</tr>
		<tr>
			<td width="200"><strong>Header Image</strong></td>
			<td>
				{{ Form::file('header_image') }}
			</td>
		</tr>
	</table>
	{{ Form::submit('Speichern', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop