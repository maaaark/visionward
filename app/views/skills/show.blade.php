@extends('layouts.small_header')
@section('title', $skill->name)
@section('subtitle', $skill->champion->name)
@section('content')
	<table class="table">
		<tbody>
				<tr>
					<td width="90"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/item/{{ $skill->id }}.png" class="img-circle" ></td>
					<td class="text-left">
						<a href="/items/{{ $skill->id }}">{{ $skill->name }}</a><br/>
						<br/>
						{{ $skill->description }}
					</td>
				</tr>
		</tbody>
	 </table>
@stop