@extends('layouts.small_header')
@section('title', "League of Legends Caster und Hosts")
@section('subtitle', "Professionelle Kommentaroren und Hosts")
@section('content')
	@foreach($vips as $vip)
		<a href="/vips/{{ $vip->id }}/{{ $vip->slug }}"><img src="/img/vips/{{ $vip->header_image }}" /></a>
	@endforeach
@stop