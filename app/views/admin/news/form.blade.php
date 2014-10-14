	{{ Form::hidden('id', Input::old('news_id')) }}
	{{ Form::text('title', Input::old('title'),  array('class' => 'form-control')) }}
	<br/>
	{{ Form::text('slug', Input::old('slug'),  array('class' => 'form-control')) }}
	<br/>
	{{ Form::textarea('excerpt', Input::old('excerpt'),  array('class' => 'edit_content wysiwyg')) }}
	<br/>
	{{ Form::textarea('content', Input::old('content'),  array('class' => 'edit_content wysiwyg')) }}
	<br/>
	<table class="table table-striped">
		<tr>
			<td width="200"><strong>Korrektur gelesen?</strong></td>
			<td>{{ Form::checkbox('corrected', 1, Input::old('corrected')) }}</td>
		</tr>
		<tr>
			<td width="200"><strong>Veröffentlicht</strong></td>
			<td>{{ Form::checkbox('published', 1, Input::old('published')) }}</td>
		</tr>
		<tr>
			<td width="200"><strong>Kategorien</strong></td>
			<td>
				@foreach($categories as $category)
					@if(isset($post))
						@if($post->hasCategory($category->slug))
							<label><input tabindex="1" checked="checked" type="checkbox" name="category[]" id="{{$category->id}}" value="{{$category->id}}"> {{ $category->name }}</label>
						@else
							<label><input tabindex="1" type="checkbox" name="category[]" id="{{$category->id}}" value="{{$category->id}}"> {{ $category->name }}</label>
						@endif
					@else
						<label><input tabindex="1" type="checkbox" name="category[]" id="{{$category->id}}" value="{{$category->id}}"> {{ $category->name }}</label>
					@endif
					<br/>
				@endforeach
			</td>
		</tr>
		<tr>
			<td><strong>News Image</strong></td>
			<td>
				{{ Form::file('image') }}
				@if(isset($post))
					<br/>
					<strong>Aktuelles Bild:</strong><br/>
					<img src="/uploads/news/{{ $post->image }}" width="200">
				@endif
			</td>
		</tr>
		<tr>
			<td><strong>Erstellungsdatum</strong></td>
			<td>
				{{ Form::text('created_at', Input::old('created_at'),  array('class' => 'form-control')) }}
			</td>
		</tr>
	</table>
