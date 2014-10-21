@extends('layouts.small_header')
@section('title', "Champions")
@section('subtitle', "Alle Champions aus Runterra")
@section('content')
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