@extends('layouts.small_header')
@section('title', "Counterpicks")
@section('subtitle', "Wer ist gut gegen wen? Findet es heraus!")
@section('content')
	<ul class="counter_list">
		@foreach($counterpicks as $pick)
			<li>
				<a href="/champions/{{ $pick->counter->key }}">
					<img src="http://ddragon.leagueoflegends.com/cdn/4.17.1/img/champion/{{ $pick->counter->key }}.png" class="img-circle" width="100" /><br/>
					{{ $pick->counter->name }}
					<br/><br/>
					<span class="votes">{{ $pick->votes }} Votes</span><br/><br/>
					<span class="upvote">{{ $pick->upvotes }} Upvotes</span><br/><br/>
					<span class="downvote">{{ $pick->downvotes }} Downvotes</span>
				</a>
			</li>
		@endforeach
	</ul>

@stop