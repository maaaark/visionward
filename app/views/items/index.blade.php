@extends('layouts.small_header')
@section('title', "Items")
@section('header_image',"summoner_header.jpg")
@section('content')
<br/>
	<ul id="inputList"> 
    <li><input id="type-A" type="checkbox" > <a href="/A">A</a></li>
    <li><input id="type-B" type="checkbox" > <a href="/B">B</a></li>
    <li><input id="type-C" type="checkbox" > <a href="/C">C</a></li>
    <li><input id="type-D" type="checkbox" > <a href="/D">D</a></li>
    <li><input id="type-E" type="checkbox" > <a href="/E">E</a></li>
    <li><input id="type-Z" type="checkbox" > <a href="/Z">KEKS</a></li>
</ul>

<ul id="list">
    <li class="z">Z</li>
    <li class="B">filler</li>
    <li class="A B">filler</li>
    <li class="C D">filler</li>
    <li class="A F">filler</li>
    <li class="A E F">filler</li>
    <li class="F">filler</li>
    <li class="C D E">filler</li>
    <li class="A B C D E F">filler</li>
</ul>


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

