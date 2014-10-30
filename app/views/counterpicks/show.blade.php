@extends('layouts.small_header')
@section('title', $champion->name)
@section('subtitle', $champion->title)
@section('content')
	<div class="row">
	  <div class="col-xs-2 col-md-2 hidden-xs hidden-sm">
		<img src="http://ddragon.leagueoflegends.com/cdn/4.17.1/img/champion/{{ $champion->key }}.png" class="img-circle" width="100" />
	  </div>
	  <div class="col-xs-10 col-md-10">
			@include("counterpicks.list")
	  </div>
	</div>
	<br/><br/>
	@include("layouts.disqus")
@stop