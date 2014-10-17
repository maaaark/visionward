{{ Form::hidden('id', Input::old('gallery_id')) }}
<table class="table table-striped">
	<tr>
		<td width="200"><strong>Titel</strong></td>
		<td>{{ Form::text('title', Input::old('title'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Team 1</strong></td>
		<td>
			<select name="team_id_1">
				@if(isset($match))
				<option value="{{ $match->team->id }}">{{ $match->team->name }}</option>	
				@endif
				@foreach($teams as $team)
				<option value="{{ $team->id }}">{{ $team->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
	<tr>
		<td width="200"><strong>Team 2</strong></td>
		<td>
			<select name="team_id_2">
				@if(isset($match))
				<option value="{{ $match->team2->id }}">{{ $match->team2->name }}</option>	
				@endif
				@foreach($teams as $team)
				<option value="{{ $team->id }}">{{ $team->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
	<tr>
		<td width="200"><strong>Liga / Turnier</strong></td>
		<td>
			<select name="league_id">
				@if(isset($match))
				<option value="{{ $match->league->id }}">{{ $match->league->name }}</option>	
				@endif
				@foreach($leagues as $league)
				<option value="{{ $league->id }}">{{ $league->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
	<tr>
		<td width="200"><strong>Best of</strong></td>
		<td>{{ Form::text('bestof', Input::old('bestof'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Punkte Team 1</strong></td>
		<td>{{ Form::text('result_team_1', Input::old('result_team_1'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Punkte Team 2</strong></td>
		<td>{{ Form::text('result_team_2', Input::old('result_team_2'),  array('class' => 'form-control')) }}</td>
	</tr>
	@if(isset($match))
	<tr>
		<td width="200"><strong>Gewinner</strong></td>
		<td>
			<select name="winner_team_id">
				<option value="{{ $match->team->id }}">{{ $match->team->name }}</option>
				<option value="{{ $match->team2->id }}">{{ $match->team2->name }}</option>	
			</select>
		</td>
	</tr>
	@endif
	<tr>
		<td width="200"><strong>Spiel Datum</strong></td>
		<td>{{ Form::text('game_date', Input::old('game_date'),  array('class' => 'form-control')) }}</td>
	</tr>
</table>