@extends('layouts.small_header')
@section('title', "League of Legends Caster und Hosts")
@section('subtitle', "Professionelle Kommentaroren und Hosts")
@section('content')
	@foreach($vips as $vip)
		<h2 class="headline">{{$vip->first_name}} '{{$vip->nickname}}' {{$vip->last_name}}</h2>
		<a href="/vips/{{ $vip->id }}/{{ $vip->slug }}"><img src="/img/vips/{{ $vip->header_image }}" /></a>
		<br/><br/>
	@endforeach
@stop