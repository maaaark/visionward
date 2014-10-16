{{ Form::hidden('id', Input::old('picture_id')) }}
<table class="table table-striped">
	<tr>
		<td width="200"><strong>Bild</strong></td>
		<td>
			{{ Form::file('images[]', ['multiple' => true]) }}
			@if(isset($picture))
				<br/>
				<img src="{{ "/uploads/galleries/".$picture->destination."/".$picture->filename }}" />
			@endif
		</td>
	</tr>
	<tr>
		<td width="200"><strong>Galerie</strong></td>
		<td>
			<select name="gallery_id">
			@if(isset($picture))
				@if($picture->gallery_id != 0)
					<option value="{{ $picture->gallery_id }}">{{ $picture->gallery->title }}</option>
				@endif
			@endif
				<option value="0">- Galerie auswählen -</option>
			@foreach($galleries as $gallery)
				<option value="{{ $gallery->id }}">{{ $gallery->title }}</option>
			@endforeach
			</select>
		</td>
	</tr>
</table>