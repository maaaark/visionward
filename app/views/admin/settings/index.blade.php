@extends('layouts.admin')
@section('title', "Settings")
@section('content')
	
	<table class="table table-striped">
		<tr>
			<th>ID</th>
			<th>Label</th>
			<th>Value</th>
		</tr>
		@foreach($settings as $setting)
			<tr>
				<td><a href="/admin/settings/edit/{{ $setting->id }}">{{ $setting->id }}</a></td>
				<td><a href="/admin/settings/edit/{{ $setting->id }}">{{ $setting->label }}</a></td>
				<td><a href="/admin/settings/edit/{{ $setting->id }}">{{ $setting->value }}</a></td>
			</tr>
		@endforeach
	</table>
	<!--<a href="/admin/settings/create" class="btn btn-primary">Neuen setting anlegen</a>-->
	
@stop