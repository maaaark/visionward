	<table class="table table-striped">
		<tr>
			<td width="200"><strong>Titel</strong></td>
			<td>{{ Form::text('title', Input::old('title'),  array('class' => 'form-control')) }}</td>
		</tr>
		@if(isset($article))
		<tr>
			<td width="200"><strong>Autor</strong></td>
			<td>
				<select name="user_id">
						<option value="{{ $article->user_id }}">{{ $article->user->username }}</option>
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
		@if(isset($article))
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
				@if(isset($article))
					@if($article->image != "")
					<br/>
					<strong>Aktuelles Bild:</strong><br/>
					<img src="/uploads/articles/{{ $article->image }}" width="200">
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td><strong>Galerie</strong></td>
			<td>
				<select name="gallery_id">
				@if(isset($article))
					@if($article->gallery_id != 0)
						<option value="{{ $article->gallery_id }}">{{ $article->gallery->title }}</option>
					@endif
				@endif
					<option value="0">- Galerie auswählen -</option>
						
				@foreach($galleries as $gallery)
						<option value="{{ $gallery->id }}">{{ $gallery->title }}</option>
				@endforeach
				</select>
			</td>
		</tr>
		@if(isset($article))
		<tr>
			<td><strong>Erstellungsdatum</strong></td>
			<td>
				{{ Form::text('created_at', Input::old('created_at'),  array('class' => 'form-control')) }}
			</td>
		</tr>
		@endif
		<tr>
			<td><strong>Autorenbox anzeigen?</strong></td>
			<td>
				{{ Form::checkbox('show_autorbox', 1, Input::old('show_autorbox')) }}
			</td>
		</tr>
	</table>