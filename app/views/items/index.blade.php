@extends('layouts.small_header')
@section('title', "Items")
@section('header_image',"summoner_header.jpg")
@section('content')
<br/>
	<table class="table table-striped">
		<tbody>
			@foreach($items as $item)
				<tr>
					<td><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/item/{{ $item->id }}.png" width="30" class="img-circle" ></td>
					<td class="text-left"><a href="/items/{{ $item->id }}">{{ $item->name }}</a></td>
					<td class="text-left">{{ $item->description }}</td>
				</tr>
			@endforeach
		</tbody>
	 </table>
@stop

