<table class="table table-striped">
    <tr>
		<th>Name</th>
		<th>Rang</th>
		<th>Letzter Rang</th>
		<th>Win</th>
		<th>Loss</th>
		<th>Bearbeiten</th>
	</tr>
	@foreach($league->standings as $standing)
		<tr>
			<td width="200"><strong>{{ $standing->team->name }}</strong></td>
			<td>{{ $standing->rank }}</td>
			<td>{{ $standing->last_rank }}</td>
			<td>{{ $standing->wins }}</td>
			<td>{{ $standing->loss }}</td>
			<td><a href="/admin/standings/{{ $standing->id }}/edit">Bearbeiten</a></td>
		</tr>
	@endforeach	
</table>
<a href="/admin/leaguestandings/new">Neue Liga Platzierung</a>