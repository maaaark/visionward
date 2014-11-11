<table class="table table-striped">
    <tr>
		<td width="200"><strong>Name</strong></td>
		<td>{{ Form::text('name', Input::old('name'),  array('class' => 'form-control')) }}</td>
	</tr>
    <tr>
		<td width="200"><strong>Logo</strong></td>
		<td>{{ Form::text('logo', Input::old('logo'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Region</strong></td>
		<td>{{ Form::text('region', Input::old('region'),  array('class' => 'form-control')) }}</td>
	</tr>
    <tr>
		<td width="200"><strong>Beschreibung</strong></td>
		<td>{{ Form::textarea('description', Input::old('description'),  array('class' => 'form-control')) }}</td>
	</tr>
</table>