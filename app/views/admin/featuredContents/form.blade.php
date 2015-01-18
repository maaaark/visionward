{{ Form::hidden('id', Input::old('featuredContent_id')) }}
<table class="table table-striped">
	<tr>
		<td width="200"><strong>Bild</strong></td>
		<td>
			{{ Form::file('images', ['multiple' => false]) }}
			@if(isset($featuredContent))
				<br/>
				<img src="{{ "/uploads/featuredContents/".$featuredContent->destination."/".$featuredContent->filename }}" width="200" />
			@endif
		</td>	
	</tr>
	<tr>
		<td width="200"><strong>Headline</strong></td>
		<td>
				{{ Form::text('headline', Input::old('headline'),  array('class' => 'form-control')) }}
		</td>	
	</tr>
	<tr>
		<td width="200"><strong>URL</strong></td>
		<td>
				{{ Form::text('url', Input::old('url'),  array('class' => 'form-control')) }}
		</td>	
	</tr>
	<tr>
		<td width="200"><strong>Veröffentlicht</strong></td>
		<td>
				{{ Form::checkbox('published', 1, Input::old('published')) }}
		</td>	
	</tr>
	<tr>
		<td width="200"><strong>Sortierung</strong></td>
		<td>
				{{ Form::text('order', Input::old('order'),  array('class' => 'form-control')) }}
		</td>	
	</tr>
</table>