@extends('layouts.small_header')
@section('title', "Champions")
@section('subtitle', "Alle Champions aus Runterra")
@section('content')
	<h2 class="headline">Champions</h2>	
	<div class="filterbox">
		<input type="text" name="champion_filter" class="champion_filter" placeholder="Champion Suche" />
	</div>
	
	<ul class="champion_list">
		@foreach($champions as $champion)
			<?php 
				if(Str::lower($champion->key) == "monkeyking") {
					$champkey = "wukong";
				} else {
					$champkey = Str::lower($champion->key);
				} 
			?>
			@if($champion->f2p == true)
				<?php $class="f2p"; ?>
			@elseif($champion->sale == true)
				<?php $class="champion_on_sale"; ?>
			@else
				<?php $class=""; ?>
			@endif
			<li name="{{ $champkey }}">
				<a href="/champions/{{ $champion->key }}">
					<div class="champion_avatar">
						@if($champion->f2p == true)
							<div class="free_week"><img src="/img/kostenlos.png" alt="Diese Woche kostenlos" /></div>
						@elseif($champion->sale == true)
							<div class="on_sale"><img src="/img/angebot.png" alt="Im Angebot" /></div>
						@endif
						<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $champion->key }}.png" class="img-circle {{ $class }}" width="55" /><br/>
						{{ $champion->name }}
					</div>
				</a>
			</li>
		@endforeach
	</ul>

@stop