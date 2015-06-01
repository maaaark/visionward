@extends('layouts.small_header')
@section('title', "Champions")
@section('subtitle', "Alle Champions aus Runterra")
@section('content')
	<h2 class="headline">Champions</h2>	
	<ul id="inputList filterlist" style="margin: 0; padding: 0;"> 
	    <li class="filter_role"><input id="type-fighter" type="checkbox" > Kämpfer</li>
		<li class="filter_role"><input id="type-tank" type="checkbox" > Tank</li>
		<li class="filter_role"><input id="type-assassin" type="checkbox" > Assassin</li>
		<li class="filter_role"><input id="type-mage" type="checkbox" > Magier</li>
		<li class="filter_role"><input id="type-support" type="checkbox" > Supporter</li>
		<li class="filter_role"><input id="type-marksman" type="checkbox" > Schütze</li>
	</ul>
	<div class="clear"></div>
	<br/>
	<div class="filterbox">
		<input type="text" name="champion_filter" class="champion_filter" placeholder="Champion Suche" />
	</div>
	
	<ul id="list" class="champion_list">
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
			<li name="{{ $champkey }}" class="{{ strtolower($champion->tags) }}">
				<a href="/champion/{{ $champion->key }}">
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