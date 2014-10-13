@extends('layouts.master')
@section('title', "Champions")
@section('content')
	
	<table>
		@foreach($champions as $champion)
			<tr>
				<td><img src="http://ddragon.leagueoflegends.com/cdn/4.17.1/img/champion/{{ $champion->key }}.png" class="img-circle" width="30" /></td>
				<td><a href="/champions/{{ $champion->key }}">{{ $champion->name }}</a></td>
			</tr>
		@endforeach
	</table>

@stop