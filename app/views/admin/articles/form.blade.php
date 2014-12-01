	<table class="table table-striped">
		<tr>
			<td width="200"><strong>Titel</strong></td>
			<td>{{ Form::text('title', Input::old('title'),  array('class' => 'form-control')) }}</td>
		</tr>
		@if(isset($post))
		<tr>
			<td width="200"><strong>Autor</strong></td>
			<td>
				<select name="user_id">
						<option value="{{ $post->user_id }}">{{ $post->user->username }}</option>
				@foreach($users as $user)
						<option value="{{ $user->id }}">{{ $user->username }}</option>
				@endforeach
				</select>
			</td>
		</tr>
		@endif
		<tr>
			<td width="200"><strong>Excerpt</strong></td>
			<td>{{ Form::textarea('excerpt', Input::old('excerpt'),  array('class' => 'edit_content ckeditor', 'id' => 'news_editor')) }}</td>
		</tr>
		<tr>
			<td width="200"><strong>Content</strong></td>
			<td>{{ Form::textarea('content', Input::old('content'),  array('class' => 'edit_content ckeditor')) }}</td>
		</tr>
		@if(isset($post))
		<tr>
			<td width="200"><strong>Korrektur gelesen?</strong></td>
			<td>{{ Form::checkbox('corrected', 1, Input::old('corrected')) }}</td>
		</tr>
		<tr>
			<td width="200"><strong>Veröffentlicht</strong></td>
			<td>{{ Form::checkbox('published', 1, Input::old('published')) }}</td>
		</tr>
		@endif
		<tr>
			<td><strong>Artikel Image</strong></td>
			<td>
				{{ Form::file('image') }}
				@if(isset($post))
					@if($post->image != "")
					<br/>
					<strong>Aktuelles Bild:</strong><br/>
					<img src="/uploads/news/{{ $post->image }}" width="200">
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td><strong>Galerie</strong></td>
			<td>
				<select name="gallery_id">
				@if(isset($post))
					@if($post->gallery_id != 0)
						<option value="{{ $post->gallery_id }}">{{ $post->gallery->title }}</option>
					@endif
				@endif
					<option value="0">- Galerie auswählen -</option>
						
				@foreach($galleries as $gallery)
						<option value="{{ $gallery->id }}">{{ $gallery->title }}</option>
				@endforeach
				</select>
			</td>
		</tr>
		<tr>
			<td><strong>Erstellungsdatum</strong></td>
			<td>
				{{ Form::text('created_at', Input::old('created_at'),  array('class' => 'form-control')) }}
			</td>
		</tr>
		<tr>
			<td><strong>Autorenbox anzeigen?</strong></td>
			<td>
				{{ Form::checkbox('show_autorbox', Input::old('show_autorbox'), Input::old('show_autorbox')) }}
			</td>
		</tr>
	</table>