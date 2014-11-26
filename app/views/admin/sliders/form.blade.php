{{ Form::hidden('id', Input::old('slider_id')) }}
<table class="table table-striped">
	<tr>
		<td width="200"><strong>Bild</strong></td>
		<td>
			{{ Form::file('images', ['multiple' => false]) }}
			@if(isset($slider))
				<br/>
				<img src="{{ "/uploads/sliders/".$slider->destination."/".$slider->filename }}" width="200" />
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
		<td width="200"><strong>Sub-Headline</strong></td>
		<td>
				{{ Form::text('subheadline', Input::old('subheadline'),  array('class' => 'form-control')) }}
		</td>	
	</tr>
	<tr>
		<td width="200"><strong>URL</strong></td>
		<td>
				{{ Form::text('url', Input::old('url'),  array('class' => 'form-control')) }}
		</td>	
	</tr>
</table>