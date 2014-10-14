@extends('layouts.admin')
@section('title', "Neue News")
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
	
	{{ Form::open(array('action' => 'AdminPostsController@save')) }}	
	<input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}" />
	@include('admin.news.form')
	{{ Form::submit("Speichern", array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop