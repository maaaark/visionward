@extends('layouts.master')
@section('title', "Neuer Konterpick")
@section('content')
	<h2 class="headline">Neuer Konterpick</h2>
	

	

	  
	 {{ Form::open(array('action' => 'CounterpicksController@create_counter')) }}	
	<table class="table table-striped">
		<tr>
			<td>champ</td>
			<td>ist</td>
			<td>Konter art</td>
			<td>Konter</td>
		</tr>
		<tr>
			<td>
				<select name="champ" class="">
					<option value="{{$champ->champion_id}}">{{ $champ->name }}</option>
					@foreach($champions as $champion)
						<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>	
					@endforeach
			   </select>		
			</td>
			<td>ist</td>
			<td>				
				<select name="choose_type" class="">
					<option value="0">Bitte wählen</option>
					<option value="good">Gut gegen</option>	
					<option value="bad">Schlecht gegen</option>	
				</select>		
			</td>
			<td>
				<select name="choose_counter" class="">
					<option value="0">Bitte wählen</option>
					@foreach($champions as $champion)
						@if($champ->id != $champion->id)
						<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>	
						@endif
					@endforeach
			   </select>				
			</td>
		</tr>
	</table>
	{{ Form::submit('Speichern', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}

@stop