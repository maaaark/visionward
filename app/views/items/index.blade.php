@extends('layouts.small_header')
@section('title', "Items")
@section('header_image',"summoner_header.jpg")
@section('content')
<ul id="inputList filterlist" style="margin: 0; padding: 0;"> 
    <li class="filter_value"><input id="type-spelldamage" type="checkbox" > Zauberschaden</li>
	<li class="filter_value"><input id="type-spelldamage" type="checkbox" > Lane</li>
	<li class="filter_value"><input id="type-spelldamage" type="checkbox" > Jungle</li>
	<li class="filter_value"><input id="type-consumable" type="checkbox" > Konsumierbar</li>
	<li class="filter_value"><input id="type-goldper" type="checkbox" > Gold über Zeit</li>
	<li class="filter_value"><input id="type-vision" type="checkbox" > Sicht</li>
	<li class="filter_value"><input id="type-health" type="checkbox" > Leben</li>
	<li class="filter_value"><input id="type-armor" type="checkbox" > Rüstung</li>
	<li class="filter_value"><input id="type-spellblock" type="checkbox" > Zauberblock</li>
	<li class="filter_value"><input id="type-damage" type="checkbox" > Schaden</li>
	<li class="filter_value"><input id="type-criticalstrike" type="checkbox" > Kritisch</li>
	<li class="filter_value"><input id="type-attackspeed" type="checkbox" > Angriffsgeschw..</li>
	<li class="filter_value"><input id="type-lifesteal" type="checkbox" > Lebensraub</li>
	<li class="filter_value"><input id="type-cooldownreduction" type="checkbox" > Abklingzeitver..</li>
	<li class="filter_value"><input id="type-mana" type="checkbox" > Mana</li>
	<li class="filter_value"><input id="type-manaregen" type="checkbox" > Manaregeneration</li>
	<li class="filter_value"><input id="type-boots" type="checkbox" > Schuhe</li>
	<li class="filter_value"><input id="type-nonbootsmovement" type="checkbox" > Geschwindigkeit</li>
	<li class="filter_value"><input id="type-active" type="checkbox" > Aktivierbar</li>
	<li class="filter_value"><input id="type-armorpenetration" type="checkbox" > Rüstungsdurchdr..</li>
	<li class="filter_value"><input id="type-aura" type="checkbox" > Aura</li>
	<li class="filter_value"><input id="type-magicpenetration" type="checkbox" > Zauberdurchdr..</li>
	<li class="filter_value"><input id="type-onhit" type="checkbox" > On Hit</li>
	<li class="filter_value"><input id="type-slow" type="checkbox" > Verlangsamung</li>
	<li class="filter_value"><input id="type-stealth" type="checkbox" > Unsichtbar</li>
	<li class="filter_value"><input id="type-trinket" type="checkbox" > Trinket</li>
	<li class="filter_value"><input id="type-spellvamp" type="checkbox" > Zaubervampir</li>
</ul>
<div class="clear"></div>
<br/>
	<ul id="list" class="champion_list">
		@foreach($items as $item)
		<li class="{{ strtolower($item->tags) }}" style="height: 100px;">
			<a href="/items/{{ $item->id }}">
				<div class="champion_avatar">
					<img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/item/{{ $item->id }}.png" width="30" class="img-circle" ><br/>
					{{ $item->name }}
				</div>
			</a>
		</li>
		@endforeach
	</ul>
@stop

