@extends('layouts.admin')
@section('title', "VIPs")
@section('content')
	
	<table class="table table-striped">
			<tr>
				<th>Nickname</th>
				<th>Name</th>
                <th></th>
			</tr>
		@foreach($vips as $vip)
			<tr>
				<td><a href="/admin/vips/{{ $vip->id }}/edit">{{ $vip->nickname }}</a></td>
				<td><a href="/admin/vips/{{ $vip->id }}/edit">{{ $vip->first_name }} {{ $vip->last_name }}</a></td>
				<td>
					{{ Form::open(array('url' => 'admin/vips/' . $vip->id, 'class' => '')) }}
						{{ Form::hidden('_method', 'DELETE') }}
						{{ Form::submit('löschen', array('class' => 'delete')) }}
					{{ Form::close() }}
				</td>
			</tr>
		@endforeach
	</table>
	<a href="/admin/vips/create" class="btn btn-primary">Neuen VIP erstellen</a>
	
@stop