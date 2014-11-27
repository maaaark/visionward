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
		<td width="200"><strong>Aufgabe</strong></td>
		<td>{{ Form::text('task', Input::old('task'),  array('class' => 'form-control')) }}</td>
	</tr>
	 <tr>
		<td width="200"><strong>Land</strong></td>
		<td>{{ Form::text('country', Input::old('country'),  array('class' => 'form-control')) }}</td>
	</tr>
    <tr>
		<td width="200"><strong>Bild</strong></td>
		<td>{{ Form::text('image', Input::old('image'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Listen Bild</strong></td>
		<td>{{ Form::text('header_image', Input::old('header_image'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Summoner Name</strong></td>
		<td>{{ Form::text('summoner', Input::old('summoner'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Region</strong></td>
		<td>{{ Form::text('region', Input::old('region'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Twitter Account</strong></td>
		<td>{{ Form::text('twitter', Input::old('twitter'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Facebook Account</strong></td>
		<td>{{ Form::text('facebook', Input::old('facebook'),  array('class' => 'form-control')) }}</td>
	</tr>
    <tr>
		<td width="200"><strong>Beschreibung</strong></td>
		<td>{{ Form::textarea('description', Input::old('description'),  array('class' => 'form-control')) }}</td>
	</tr>
</table>