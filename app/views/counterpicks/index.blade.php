@extends('layouts.master')
@section('title', "Counterpicks")
@section('content')
	<h2 class="headline">Champions</h2>
	<ul class="champion_list">
		@foreach($counterpicks as $pick)
			<li>
				<a href="/champions/{{ $pick->champion->key }}">
					<img src="http://ddragon.leagueoflegends.com/cdn/4.17.1/img/champion/{{ $pick->champion->key }}.png" class="img-circle" width="55" /><br/>
					{{ $pick->counter->name }}
				</a>
			</li>
		@endforeach
	</ul>

@stop