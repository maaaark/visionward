@extends('layouts.small_header')
@section('title', "Counterpicks")
@section('subtitle', "Wer ist gut gegen wen? Findet es heraus!")
@section('content')
	<ul class="champion_list">
		@foreach($counterpicks as $pick)
			<li>
				<a href="/champions/{{ $pick->counter->key }}">
					<img src="http://ddragon.leagueoflegends.com/cdn/4.17.1/img/champion/{{ $pick->counter->key }}.png" class="img-circle" width="55" /><br/>
					{{ $pick->counter->name }}
				</a>
			</li>
		@endforeach
	</ul>

@stop