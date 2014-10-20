@extends('layouts.master')
@section('title', "Champions")
@section('content')
	<h2 class="headline">Champions</h2>
	<ul class="champion_list">
		@foreach($champions as $champion)
			<li>
				<a href="/champions/{{ $champion->key }}">
					<img src="http://ddragon.leagueoflegends.com/cdn/4.17.1/img/champion/{{ $champion->key }}.png" class="img-circle" width="55" /><br/>
					{{ $champion->name }}
				</a>
			</li>
		@endforeach
	</ul>

@stop