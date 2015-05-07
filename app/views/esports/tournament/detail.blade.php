@extends('layouts.header_esports')
@section('title', "Esports")
@section('esports_navi_elements')
		@include('esports.tournament.navi')
@stop
@section('opener')
	@include('esports.tournament_header')
@stop
@section('content')
	<script>$(".esports_opener_navi .esports_header_navi .element.overview").addClass("active");</script>
	<h1>Übersicht</h1>
	Hier erscheint die Tabelle
@stop