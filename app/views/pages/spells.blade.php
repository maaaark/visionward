@extends('layouts.no_sidebar')
@section('title', "Impressum" )
@section('subtitle', "Rechtliches" )
@section('header_image',"pro_teams.jpg")
@section('content')

	@foreach($champions as $champion)
		{{ $champion->name }}<br/>
	@endforeach
	
@stop