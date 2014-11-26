@extends('layouts.admin')
@section('title', "Sliders")
@section('content')
	
	<table class="table table-striped">
			<tr>
				<th>ID</th>
				<th>Image</th>
				<th>Galerie</th>
				<th>Erstellt</th>
				<th>Löschen</th>
			</tr>
		@foreach($sliders as $slider)
			<tr>
				<td><a href="/admin/sliders/edit/{{ $slider->id }}">{{ $slider->id }}</a></td>
				<td><a href="/admin/sliders/edit/{{ $slider->id }}">{{ $slider->filename }}</a></td>
				@if($slider->gallery_id != 0)
				<td><a href="/admin/sliders/edit/{{ $slider->id }}">{{ $slider->gallery->title }}</a></td>
				@else
				<td><a href="/admin/sliders/edit/{{ $slider->id }}">-</a></td>
				@endif
				<td>{{ $slider->created_at }}</td>
				<td><a href="/admin/sliders/delete/{{ $slider->id }}" class="delete">Löschen</a></td>
			</tr>
		@endforeach
	</table>
	<a href="/admin/sliders/create" class="btn btn-primary">Neues Bild hochladen</a>
	
@stop