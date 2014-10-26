<div class="row">
  <div class="col-xs-12 col-md-6">
	<h2 class="headline_no_border">{{ $champion->name }} ist gut gegen</h2>
	<table class="table table-striped">
	@foreach($good as $g)
		<tr>
			<td width="65"><a href="/counterpicks/{{ $champion->champion_id }}/{{ $champion->key }}/{{ $g->champion->champion_id }}/{{ $g->champion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/4.17.1/img/champion/{{ $g->champion->key }}.png" class="img-circle" width="50" /></a></td>
			<td valign="top">
				<a href="/counterpicks/{{ $champion->champion_id }}/{{ $champion->key }}/{{ $g->champion->champion_id }}/{{ $g->champion->key }}">{{ $g->champion->name }}</a><br/>
				<a href="/championvotes/{{ $g->id}}/up"><span class="upvote">{{ $g->upvotes }} Upvotes</span></a> <a href="/championvotes/{{ $g->id}}/down"><span class="downvote">{{ $g->downvotes }} Downvotes</span></a>
			</td>
		</tr>
	@endforeach
	</table>
	<div class="center">
		<a href="/counterpicks/create/{{$champion->id}}" class="button">Neuen Konterpick erstellen</a>
	</div>
  </div>
  <div class="col-xs-12 col-md-6">
	<h2 class="headline_no_border">{{ $champion->name }} ist schlecht gegen</h2>
	<table class="table table-striped">
	@foreach($bad as $g)
		<tr>
			<td width="65"><a href="/counterpicks/{{ $champion->champion_id }}/{{ $champion->key }}/{{ $g->champion->champion_id }}/{{ $g->champion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/4.17.1/img/champion/{{ $g->champion->key }}.png" class="img-circle" width="50" /></a></td>
			<td valign="top">
				<a href="/counterpicks/{{ $champion->champion_id }}/{{ $champion->key }}/{{ $g->champion->champion_id }}/{{ $g->champion->key }}">{{ $g->champion->name }}</a><br/>
				<a href="/championvotes/{{ $g->id}}/up"><span class="upvote">{{ $g->upvotes }} Upvotes</span></a>
				<a href="/championvotes/{{ $g->id}}/down"><span class="downvote">{{ $g->downvotes }} Downvotes</span></a>
			</td>
		</tr>
	@endforeach
	</table>
	<div class="center">
		<a href="/counterpicks/create/{{$champion->id}}" class="button">Neuen Konterpick erstellen</a>
	</div>
  </div>
</div>