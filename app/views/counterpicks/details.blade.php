@extends('layouts.small_header')
@section('title', $champion->name." vs. ".$counter->name)
@section('subtitle', $champion->title." vs. ".$counter->title)
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
		<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $champion->key }}.png" class="img-circle" width="100" />
	  </div>
	  <div class="col-xs-12 col-md-2 center">
		<h3>vs.</h3>
		<div class="upvote">{{ $counterpick->upvotes }} <span class="glyphicon glyphicon-thumbs-up"></span></div> 
		<br/>
		<div class="downvote">{{ $counterpick->downvotes }} <span class="glyphicon glyphicon-thumbs-down"></span></div>
		<br/>
		<div style="width: 100px;" class="vote_lane">{{ Helpers::niceRole($counterpick->lane) }}</div>
	  </div>
	  <div class="col-xs-12 col-md-5 center">
		<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $counter->key }}.png" class="img-circle" width="100" />
	  </div>
	</div>
	<br/><br/>
	<h2 class="headline">So spielt ihr gegen {{ $counter->name }}</h2>
	{{ $counterpick->description }}
	<br/><br/>
	@include("layouts.disqus")
@stop