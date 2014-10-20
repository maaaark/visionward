@extends('layouts.master')
@section('title', "Champions / ".$champion->name)
@section('content')
	<h2 class="headline">{{ $champion->name }}, {{ $champion->title }}</h2>
	<div class="row">
	  <div class="col-xs-2 col-md-2">
		<img src="http://ddragon.leagueoflegends.com/cdn/4.17.1/img/champion/{{ $champion->key }}.png" class="img-circle" width="100" />
	  </div>
	  <div class="col-xs-10 col-md-10">
		Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
	  </div>
	</div>
	<br/><br/>
	@include("counterpicks.list")
@stop