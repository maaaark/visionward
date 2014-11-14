<table class="table table-striped">
	<tr>
		<td width="200"><strong>Champ</strong></td>
		<td>
			<select name="counter_champion_id">
				@if(isset($counterpick))
				<option value="{{ $counterpick->counter_champion_id }}">{{ $counterpick->counter->name }}</option>	
				@endif
				@foreach($champions as $champion)
				<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
	<tr>
		<td width="200"><strong>good/bad</strong></td>
	<td>		
		<select name="type">
		@if(isset($counterpick))
			<option value="{{ $counterpick->type }}">{{ $counterpick->type }} vs.</option>	
		@endif
		<option value="good">good vs.</option>	
		<option value="bad">bad vs.</option>	
		</select>
	</td>
	</tr>
	<tr>
		<td width="200"><strong>Counter</strong></td>
		<td>			
			<select name="champion_id">
				@if(isset($counterpick))
				<option value="{{ $counterpick->champion_id }}">{{ $counterpick->champion->name }}</option>	
				@endif
				@foreach($champions as $champion)
				<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
	<tr>
		<td width="200"><strong>Lane</strong></td>
	<td>		
		<select name="lane">
		@if(isset($counterpick))
			<option value="{{ $counterpick->lane }}">{{ $counterpick->lane }}</option>	
		@endif
		<option value="top">top</option>	
		<option value="mid">mid</option>	
		<option value="support">support</option>
		<option value="jungle">jungle</option>	
		<option value="adcarry">adcarry</option>	
		</select>
	</td>
	</tr>
	<tr>
		<td width="200"><strong>downvotes</strong></td>
		<td>{{ Form::text('downvotes', Input::old('downvotes'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Upvotes</strong></td>
		<td>{{ Form::text('upvotes', Input::old('upvotes'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Beschreibung</strong></td>
		<td>{{ Form::textarea('description', Input::old('description'),  array('class' => 'form-control ckeditor')) }}</td>
	</tr>
</table>