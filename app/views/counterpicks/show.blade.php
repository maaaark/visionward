@extends('layouts.master')
@section('title', "Champions / ".$champion->name)
@section('content')
	<h2 class="headline">{{ $champion->name }}, {{ $champion->title }}</h2>
	<div class="row">
	  <div class="col-xs-2 col-md-2">
		<img src="http://ddragon.leagueoflegends.com/cdn/4.17.1/img/champion/{{ $champion->key }}.png" class="img-circle" width="100" />
	  </div>
	  <div class="col-xs-10 col-md-10">
		Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
	  </div>
	</div>
	<br/><br/>
	<div class="row">
	  <div class="col-xs-12 col-md-6">
		<h2 class="headline_no_border">{{ $champion->name }} ist gut gegen</h2>
		<table class="table table-striped">
		@foreach($good as $g)
			<tr>
				<td width="65"><a href="/counterpicks/{{ $champion->champion_id }}/{{ $champion->key }}/{{ $g->champion->champion_id }}/{{ $g->champion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/4.17.1/img/champion/{{ $g->champion->key }}.png" class="img-circle" width="50" /></a></td>
				<td valign="top">
					<a href="/counterpicks/{{ $champion->champion_id }}/{{ $champion->key }}/{{ $g->champion->champion_id }}/{{ $g->champion->key }}">{{ $g->champion->name }}</a><br/>
					<span class="upvote">{{ $g->upvotes }} Upvotes</span> <span class="downvote">{{ $g->downvotes }} Downvotes</span> <a href="/counterpicks/{{ $champion->champion_id }}/{{ $champion->key }}/{{ $g->champion->champion_id }}/{{ $g->champion->key }}#disqus_thread" class="counter_comments"10 Kommentare</a>
				</td>
			</tr>
		@endforeach
		</table>
	  </div>
	  <div class="col-xs-12 col-md-6">
		<h2 class="headline_no_border">{{ $champion->name }} ist schlecht gegen</h2>
		<table class="table table-striped">
		@foreach($bad as $g)
			<tr>
				<td width="65"><a href="/counterpicks/{{ $champion->champion_id }}/{{ $champion->key }}/{{ $g->champion->champion_id }}/{{ $g->champion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/4.17.1/img/champion/{{ $g->champion->key }}.png" class="img-circle" width="50" /></a></td>
				<td valign="top">
					<a href="/counterpicks/{{ $champion->champion_id }}/{{ $champion->key }}/{{ $g->champion->champion_id }}/{{ $g->champion->key }}">{{ $g->champion->name }}</a><br/>
					<span class="upvote">{{ $g->upvotes }} Upvotes</span> <span class="downvote">{{ $g->downvotes }} Downvotes</span> <a href="/counterpicks/{{ $champion->champion_id }}/{{ $champion->key }}/{{ $g->champion->champion_id }}/{{ $g->champion->key }}#disqus_threa" class="counter_comments">0 Kommentare</a>
				</td>
			</tr>
		@endforeach
		</table>
	  </div>
	</div>
@stop