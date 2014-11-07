	{{ Form::hidden('id', Input::old('id')) }}
	<table class="table table-striped">
		<tr>
			<td width="200"><strong>Label</strong></td>
			<td>{{ Form::text('value', Input::old('value'),  array('class' => 'form-control')) }}</td>
		</tr>
	</table>
