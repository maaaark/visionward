@extends('layouts.small_header')
@section('title', $skill->name)
@section('subtitle', $skill->champion->name)
@section('content')
	<a href="/champions/{{ $skill->champion->key }}">< Zurück zu {{ $skill->champion->name }}</a><br/>
	<br/>
	<table class="table">
		<tbody>
				<tr>
					<td width="90"><img src="http://ddragon.leagueoflegends.com/cdn/{{$patchversion}}/img/spell/{{ $skill->icon}}" class="img-circle" ></td>
					<td class="text-left">
						<a href="/items/{{ $skill->id }}"><strong>{{ $skill->name }}</strong></a>
						<br/>
						{{ $skill->description }}
					</td>
				</tr>
		</tbody>
	 </table>
@stop