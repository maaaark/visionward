{{ Form::hidden('id', Input::old('gallery_id')) }}
<table class="table table-striped">
	<tr>
		<td width="200"><strong>Team</strong></td>
		<td>
			<select name="team_id">
				@if(isset($placement))
				<option value="{{ $placement->team->id }}">{{ $placement->team->name }}</option>	
				@endif
				@foreach($teams as $team)
				<option value="{{ $team->id }}">{{ $team->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
    <tr>
		<td width="200"><strong>Team 1 Top Lane</strong></td>
		<td>
			<select name="league_id">
				@if(isset($placement))
				<option value="{{ $placement->league->id }}">{{ $placement->league->name }}</option>	
				@endif
				@foreach($leagues as $league)
				<option value="{{ $league->id }}">{{ $league->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
    <tr>
		<td width="200"><strong>Platzierung</strong></td>
		<td>{{ Form::text('place', Input::old('place'),  array('class' => 'form-control')) }}</td>
	</tr>
    <tr>
		<td width="200"><strong>Sortierung</strong></td>
		<td>{{ Form::text('order', Input::old('order'),  array('class' => 'form-control')) }}</td>
	</tr>
</table>