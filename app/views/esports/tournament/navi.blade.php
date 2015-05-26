<a href="/esports/{{ str_replace(" ", "_", trim(strtolower($league->short_name))) }}/tournament/{{ $tournament->tournament_id }}">
	<div class="element overview">&Uuml;bersicht</div>
</a>
<a href="/esports/{{ str_replace(" ", "_", trim(strtolower($league->short_name))) }}/tournament/{{ $tournament->tournament_id }}/matches">
	<div class="element matches">Spiele</div>
</a>