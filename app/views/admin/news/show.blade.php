@extends('layouts.admin')
@section('title', "News - ".$post->title)
@section('content')

	<script src="/js/plugins/file_upload.min.js"></script>
	<script>
    $(function() {
        $('.wysiwyg').editable({
            // Set custom buttons with separator between them. Also include the name
            // of the buttons  defined in customButtons.
			theme: 'dark',

            // Set basic mode.
            inlineMode: false,
			

			imageButtons: ["removeImage", "replaceImage", "linkImage"],
            // Define custom buttons.
            customButtons: {
              // Alert button with Font Awesome icon.
              alert: {
                title: 'Alert',
                icon: {
                  type: 'font',

                  // Font Awesome icon class fa fa-*.
                  value: 'fa fa-info'
                },
                callback: function () {
                  alert ('Hello!')
                },
                refresh: function () { }
              },

              // Clear HTML button with text icon.
              clear: {
                title: 'Clear HTML',
                icon: {
                  type: 'txt',
                  value: 'x'
                },
                callback: function () {
                  this.setHTML('');
                  this.focus();
                },
                refresh: function () { }
              },

              // Insert HTML button with image button.
              insertHTML: {
                title: 'Champion Link',
                icon: {
                  type: 'Champion',
                  value: 'fa fa-info'
                },
                callback: function () {
                  this.insertHTML('[CHAMPION ID=103]');
                  this.saveUndoStep();
                },
                refresh: function () { }
              }
            }
        })
    });
	</script>
	
	{{ Form::open(array('action' => 'AdminController@save_news')) }}	
	<input type="hidden" class="form-control" name="news_id" value="{{ $post->id }}" />
	<input type="text" class="form-control" name="title" value="{{ $post->title }}" />
	<br/>
	<textarea name="content" class="edit_content wysiwyg">
		{{ $post->content }}
	</textarea>
	<br/>
	<table class="table table-striped">
		<tr>
			<td width="200"><strong>Korrektur gelesen?</strong></td>
			<td>{{ Form::checkbox('corrected', 1, $post->corrected) }}</td>
		</tr>
		<tr>
			<td width="200"><strong>Veröffentlicht</strong></td>
			<td>{{ Form::checkbox('published', 1, $post->published) }}</td>
		</tr>
		<tr>
			<td width="200"><strong>Kategorien</strong></td>
			<td>
				@foreach($categories as $category)
					@if($post->hasCategory($category->slug))
						
						<label><input tabindex="1" checked="checked" type="checkbox" name="category[]" id="{{$category->id}}" value="{{$category->id}}"> {{ $category->name }}</label>
					@else
						<label><input tabindex="1" type="checkbox" name="category[]" id="{{$category->id}}" value="{{$category->id}}"> {{ $category->name }}</label>
					@endif
					<br/>
				@endforeach
			</td>
		</tr>
		<tr>
			<td><strong>Erstellungsdatum</strong></td>
			<td><input type="text" class="form-control" name="created_at" value="{{ $post->created_at }}" /></td>
		</tr>
	</table>

	 
	
	
	
	<br/>
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop