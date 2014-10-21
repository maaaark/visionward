@extends('layouts.master')
@section('title', "Champions / ".$champion->name)
@section('content')
	<h2 class="headline">
		{{ $champion->name }} 
			@if($counterpick->type == "good")
				ist gut gegen
			@else
				ist schlecht gegen
			@endif 
		{{ $counter->name }}
	</h2>
		
	<div class="row">
	  <div class="col-xs-12 col-md-5 center">
		<img src="http://ddragon.leagueoflegends.com/cdn/4.17.1/img/champion/{{ $champion->key }}.png" class="img-circle" width="100" />
	  </div>
	  <div class="col-xs-12 col-md-2 center">
		<h3>vs.</h3>
		<div class="upvote">{{ $counterpick->upvotes }} Upvotes</div> 
		<br/>
		<div class="downvote">{{ $counterpick->downvotes }} Downvotes</div>
	  </div>
	  <div class="col-xs-12 col-md-5 center">
		<img src="http://ddragon.leagueoflegends.com/cdn/4.17.1/img/champion/{{ $counter->key }}.png" class="img-circle" width="100" />
	  </div>
	</div>

	<br/><br/>
	@include("layouts.disqus")
@stop