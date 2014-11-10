@extends('layouts.small_header')
@section('title', "Konterpicks")
@section('subtitle', "Wer ist gut gegen wen? Findet es heraus!")
@section('content')
	Ihr wollt wissen welcher Champion besonders gut gegen einen bestimmten anderen Champion ist?
	Dann sucht euren Champion aus der Liste und seht was seine Stärken und Schwächen sind.
	Habt ihr Tipps gegen oder für einen bestimmtes Matchup? Tragt es ein und stimmt mit ab.<br/>
	<br/>
	<br/>
	<h2 class="headline">Mein Champion</h2>
	<div class="row">
		@foreach($counterpicks as $pick)
			<div class="col-md-2 col-sm-2 col-xs-3 center">
				<a href="/counterpicks/{{ $pick->counter->champion_id }}/{{ $pick->counter->key }}">
				<div class="champion_avatar">
					<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $pick->counter->key }}.png" class="img-circle" width="75" /><br/>
					{{ $pick->counter->name }}
				</div>
				</a>
				<br/><br/>
			</div>
		@endforeach
	</div>

@stop