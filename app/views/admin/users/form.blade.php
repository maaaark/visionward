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
			<td width="200"><strong>Aufgaben</strong></td>
			<td>{{ Form::text('task', Input::old('task'),  array('class' => 'form-control')) }}</td>
		</tr>
		<tr>
			<td width="200"><strong>Bild</strong></td>
			<td>{{ Form::text('image', Input::old('image'),  array('class' => 'form-control')) }}</td>
		</tr>
		<tr>
			<td width="200"><strong>Beschreibung</strong></td>
			<td>{{ Form::textarea('description', Input::old('description'),  array('class' => 'form-control')) }}</td>
		</tr>
		<tr>
			<td width="200"><strong>Autoren Box Text</strong></td>
			<td>{{ Form::textarea('autor_text', Input::old('autor_text'),  array('class' => 'form-control')) }}</td>
		</tr>
		
		<tr>
			<td width="200"><strong>Neues Password</strong></td>
			<td>{{ Form::password('password', array('class' => 'form-control')) }}</td>
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
