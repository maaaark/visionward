@extends('layouts.header_esports')
@section('title', "Esports")
@section('content')
<h1>Esports</h1>
	@foreach($leagues as $league)
		<a href="/esports/{{ str_replace(" ", "_", trim(strtolower($league["short_name"]))) }}">{{ $league["label"] }}</a>
		<br/>
	@endforeach
@stop