	{{ Form::hidden('id', Input::old('id')) }}
	<table class="table table-striped">
		<tr>
			<td width="200"><strong>Username</strong></td>
			<td>{{ Form::text('username', Input::old('username'),  array('class' => 'form-control')) }}</td>
		</tr>
		<tr>
			<td width="200"><strong>E-Mail</strong></td>
			<td>{{ Form::text('email', Input::old('email'),  array('class' => 'form-control')) }}</td>
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
			<td width="200"><strong>Rollen</strong></td>
			<td>
				@foreach($roles as $role)
					@if(isset($user))
						@if($user->hasRole($role->name))
							<label><input tabindex="1" checked="checked" type="checkbox" name="role[]" id="{{$role->id}}" value="{{$role->id}}"> {{ $role->name }}</label>
						@else
							<label><input tabindex="1" type="checkbox" name="role[]" id="{{$role->id}}" value="{{$role->id}}"> {{ $role->name }}</label>
						@endif
					@else
						<label><input tabindex="1" type="checkbox" name="role[]" id="{{$role->id}}" value="{{$role->id}}"> {{ $role->name }}</label>
					@endif
								
					<br/>
				@endforeach
			</td>
		</tr>
	</table>
