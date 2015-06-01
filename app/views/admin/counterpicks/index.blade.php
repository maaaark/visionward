@extends('layouts.admin')
@section('title', "Counterpicks")
@section('content')
	
	<table class="table table-striped">
			<tr>
				<th>Champion</th>
				<th>Counter</th>
				<th>good/bad</th>
				<th>lane</th>
				<th>Downvotes</th>
				<th>Upvotes</th>
				<th>Votes</th>
				<th>Desription</th>
			</tr>
		@foreach($champions as $champion)
		@foreach($counterpicks as $counterpick)
			@if($champion->champion_id == $counterpick->champion_id)
			<tr>
				<td width="50px"><a href="/admin/counterpicks/{{ $counterpick->id }}/edit">{{ $counterpick->counter->name }}</a></td>
				<td width="100px"><a href="/admin/counterpicks/{{ $counterpick->id }}/edit">{{ $counterpick->champion->name }}</a></td>
				<td width="100px"><a href="/admin/counterpicks/{{ $counterpick->id }}/edit">{{ $counterpick->type }}</a></td>
				<td width="100px"><a href="/admin/counterpicks/{{ $counterpick->id }}/edit">{{ $counterpick->lane }}</a></td>
				<td width="50px"><a href="/admin/counterpicks/{{ $counterpick->id }}/edit">{{ $counterpick->downvotes }}</a></td>
				<td width="50px"><a href="/admin/counterpicks/{{ $counterpick->id }}/edit">{{ $counterpick->upvotes }}</a></td>
				<td width="50px"><a href="/admin/counterpicks/{{ $counterpick->id }}/edit">{{ $counterpick->votes }}</a></td>
				<td><a href="/admin/counterpicks/{{ $counterpick->id }}/edit">{{ $counterpick->description }}</a></td>
			</tr>
			@endif
		@endforeach
		@endforeach
	</table>
	
@stop