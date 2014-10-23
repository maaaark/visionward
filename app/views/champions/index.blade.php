@extends('layouts.small_header')
@section('title', "Champions")
@section('subtitle', "Alle Champions aus Runterra")
@section('content')
	<ul class="champion_list">
		@foreach($champions as $champion)
			@if($champion->f2p == true)
				<?php $class="f2p"; ?>
			@elseif($champion->sale == true)
				<?php $class="champion_on_sale"; ?>
			@else
				<?php $class=""; ?>
			@endif
			<li>
				<a href="/champions/{{ $champion->key }}">
					<div class="champion_avatar">
						@if($champion->f2p == true)
							<div class="free_week"><img src="/img/kostenlos.png" alt="Diese Woche kostenlos" /></div>
						@elseif($champion->sale == true)
							<div class="on_sale"><img src="/img/angebot.png" alt="Im Angebot" /></div>
						@endif
						<img src="http://ddragon.leagueoflegends.com/cdn/4.17.1/img/champion/{{ $champion->key }}.png" class="img-circle {{ $class }}" width="55" /><br/>
						{{ $champion->name }}
					</div>
				</a>
			</li>
		@endforeach
	</ul>

@stop