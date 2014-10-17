<table class="table table-striped">
	<tr>
		<td width="200"><strong>Name</strong></td>
		<td>{{ Form::text('name', Input::old('name'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Team</strong></td>
		<td>
			<select name="team_id">
				@if(isset($player))
				<option value="{{ $player->team->id }}">{{ $player->team->name }}</option>	
				@endif
				@foreach($teams as $team)
				<option value="{{ $team->id }}">{{ $team->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
	<tr>
		<td width="200"><strong>Rolle</strong></td>
		<td>
			<select name="role">
				@if(isset($player))
				<option value="{{ $player->role }}">{{ $player->role }}</option>
				@endif
				<option value="top">Top-Lane</option>
				<option value="jungle">Jungle</option>
				<option value="mid">Mid-Lane</option>
				<option value="adcarry">AD-Carry</option>
				<option value="support">Supporter</option>
			</select>
		</td>
	</tr>
	<tr>
		<td width="200"><strong>Land</strong></td>
		<td>{{ Form::text('country', Input::old('country'),  array('class' => 'form-control')) }}</td>
	</tr>
</table>