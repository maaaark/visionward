@extends('layouts.admin')
@section('title', "Champions")
@section('content')
	
	<table class="table table-striped">
			<tr>
				<th>Name</th>
				<th>F2P</th>
				<th>Sale?</th>
				<th>Sale Price</th>
			</tr>
		@foreach($champions as $champion)
			<tr>
				<td><a href="/admin/champions/{{ $champion->id }}/edit">{{ $champion->name }}</a></td>
				<td><a href="/admin/champions/{{ $champion->id }}/edit">{{ $champion->f2p }}</a></td>
				<td><a href="/admin/champions/{{ $champion->id }}/edit">{{ $champion->sale }}</a></td>
				<td><a href="/admin/champions/{{ $champion->id }}/edit">{{ $champion->sale_price }} RP</a></td>
			</tr>
		@endforeach
	</table>
	
@stop