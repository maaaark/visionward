@extends('layouts.small_header')
@section('title', "Counterpicks")
@section('subtitle', "Wer ist gut gegen wen? Findet es heraus!")
@section('content')
	
	<div class="row">
		@foreach($counterpicks as $pick)
			<div class="col-md-2 col-sm-3 col-xs-6">
				<a href="/counterpicks/{{ $pick->counter->champion_id }}/{{ $pick->counter->key }}">
				<img src="http://ddragon.leagueoflegends.com/cdn/4.17.1/img/champion/{{ $pick->counter->key }}.png" class="img-circle" width="100" /><br/>
				{{ $pick->counter->name }}
				</a>
				<br/><br/>
			</div>
		@endforeach
	</div>

@stop