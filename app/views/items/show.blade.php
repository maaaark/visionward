@extends('layouts.small_header')
@section('title', $item->name)
@section('header_image',"summoner_header.jpg")
@section('content')
	<br/>
	<a href="/items">Items</a> > <a href="/items/{{ $item->item_id }}">{{ $item->name }}</a><br/>
	<br/>
	<table class="table">
		<tbody>
				<tr>
					<td width="90"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/item/{{ $item->id }}.png" class="img-circle" ></td>
					<td class="text-left">
						<a href="/items/{{ $item->id }}">{{ $item->name }}</a><br/>
						<br/>
						{{ $item->description }}
					</td>
				</tr>
		</tbody>
	 </table>
@stop

