<table class="table table-striped">
	<tr>
		<td width="200"><strong>Name</strong></td>
		<td>{{ Form::text('name', Input::old('name'),  array('class' => 'form-control')) }}</td>
	</tr>
    <tr>
		<td width="200"><strong>Shorthandle</strong></td>
		<td>{{ Form::text('shorthandle', Input::old('name'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Logo</strong></td>
		<td>@if(isset($team))
				@if($team->logo != "")
					<img src="/img/teams/logos/{{ $team->logo }}" width="200">
				@endif
			@endif
		{{ Form::file('logo') }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Land</strong></td>
		<td>{{ Form::text('country', Input::old('country'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Region</strong></td>
		<td>{{ Form::text('region', Input::old('region'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Beschreibung</strong></td>
		<td>{{ Form::textarea('description', Input::old('description'),  array('class' => 'form-control ckeditor')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Ligen</strong></td>
		<td>			
			@foreach($leagues as $league)
					@if(isset($team))
						@if($team->hasLeague($league->slug))
							<label><input tabindex="1" checked="checked" type="checkbox" name="league[]" id="{{$league->id}}" value="{{$league->id}}"> {{ $league->name }}</label>
						@else
							<label><input tabindex="1" type="checkbox" name="league[]" id="{{$league->id}}" value="{{$league->id}}"> {{ $league->name }}</label>
						@endif
					@else
						<label><input tabindex="1" type="checkbox" name="league[]" id="{{$league->id}}" value="{{$league->id}}"> {{ $league->name }}</label>
					@endif
								
					<br/>
				@endforeach
		</td>
	</tr>
</table>