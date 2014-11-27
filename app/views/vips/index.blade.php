@extends('layouts.small_header')
@section('title', "League of Legends Caster und Hosts")
@section('subtitle', "Professionelle Kommentaroren und Hosts")
@section('content')
	@foreach($vips as $vip)
		<h2 class="headline">{{$vip->first_name}} '{{$vip->nickname}}' {{$vip->last_name}}</h2>
		<a href="/vips/{{ $vip->id }}/{{ $vip->slug }}"><img src="/img/vips/{{ $vip->header_image }}" /></a>
		<br/><br/>
	@endforeach
	<br/>
	<h2 class="headline">Vorname 'Nickname' Nachname</h2>
	<img src="/img/vips/banner22.png" />
	<img src="/img/vips/banner2.png" />
	<img src="/img/vips/banner3.png" />
	<img src="/img/vips/banner.png" />
	<img src="/img/vips/banner_hover.png" />
@stop