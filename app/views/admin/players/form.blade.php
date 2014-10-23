<table class="table table-striped">
	<tr>
		<td width="200"><strong>Nickname</strong></td>
		<td>{{ Form::text('nickname', Input::old('nickname'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Vorname</strong></td>
		<td>{{ Form::text('first_name', Input::old('first_name'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Nachname</strong></td>
		<td>{{ Form::text('last_name', Input::old('last_name'),  array('class' => 'form-control')) }}</td>
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
	
	<tr>
		<td width="200"><strong>Spielerbild</strong></td>
		<td>
			@if(isset($player))
				@if($player->picture != "")
					<img src="/img/players/{{ $player->picture }}">
				@endif
			@endif
		{{ Form::file('picture') }}</td>
	</tr>
</table>