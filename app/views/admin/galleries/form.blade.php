{{ Form::hidden('id', Input::old('gallery_id')) }}
<table class="table table-striped">
	<tr>
		<td width="200"><strong>Titel</strong></td>
		<td>{{ Form::text('title', Input::old('title'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Beschreibung</strong></td>
		<td>{{ Form::text('description', Input::old('description'),  array('class' => 'form-control')) }}</td>
	</tr>
	@if(isset($gallery))
	<tr>
		<td width="200"><strong>Slug</strong></td>
		<td>{{ Form::text('slug', Input::old('slug'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Bilder</strong></td>
		<td>
			@foreach($gallery->pictures as $image)
				<a href="/admin/pictures/edit/{{ $image->id }}">{{ $image->filename }}</a><br/>
			@endforeach
		</td>
	</tr>
	@endif
</table>