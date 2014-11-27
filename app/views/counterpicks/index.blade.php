@extends('layouts.small_header')
@section('title', "Konterpicks")
@section('subtitle', "Wer ist gut gegen wen? Findet es heraus!")
@section('content')
	Ihr wollt wissen welcher Champion besonders gut gegen einen bestimmten anderen Champion ist?
	Dann sucht euren Champion aus der Liste und seht was seine Stärken und Schwächen sind.
	Habt ihr Tipps gegen oder für einen bestimmtes Matchup? Tragt es ein und stimmt mit ab.<br/>
	<br/>
	<h2 class="headline">Konterpicks</h2>	
	
	<div class="filterbox">
		<input type="text" name="champion_filter" class="champion_filter" placeholder="Champion Suche" />
	</div>
	
	<ul class="champion_list">
		@foreach($counterpicks as $pick)
			<?php 
				if(Str::lower($pick->counter->key) == "monkeyking") {
					$champkey = "wukong";
				} else {
					$champkey = Str::lower($pick->counter->key);
				} 
			?>
			<li name="{{ $champkey }}">
				<a href="/counterpicks/{{ $pick->counter->champion_id }}/{{ $pick->counter->key }}">
					<div class="champion_avatar">
						<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $pick->counter->key }}.png" class="img-circle" width="55" /><br/>
						{{ $pick->counter->name }}
						<span class="votes_overlay">{{ $pick->votes }}</span>
					</div>
				</a>
			</li>
		@endforeach
	</ul>
	
	

@stop