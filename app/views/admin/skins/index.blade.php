@extends('layouts.admin')
@section('title', "Skins")
@section('content')
	
	<table class="table table-striped">
			<tr>
				<th>Champion</th>
				<th>Skin</th>
				<th>Im Angebot</th>
			</tr>
		@foreach($skins as $skin)
			<tr>
				<td><a href="/admin/skins/{{ $skin->id }}/edit">{{ $skin->champion->name }}</a></td>
				<td><a href="/admin/skins/{{ $skin->id }}/edit">{{ $skin->name }}</a></td>
				<td>{{ $skin->sale }}</td>
			</tr>
		@endforeach
	</table>

@stop