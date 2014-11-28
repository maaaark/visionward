@extends('layouts.small_header')
@section('title', "Neuer Konterpick")
@section('content')
	<h2 class="headline_no_border">Neuer Konterpick</h2>
	  
	 {{ Form::open(array('action' => 'CounterpicksController@create_counter')) }}	
	<table class="table table-striped">
		<tr>
			<th>Champion</th>
			<th></th>
			<th>ist</th>
			<th>Konter</th>
			<th>Rolle</th>
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
			<td>
				<select name="lane">
					<option value="top">Top-Lane</option>
					<option value="jungle">Jungle</option>
					<option value="mid">Mid-Lane</option>
					<option value="adcarry">AD-Carry</option>
					<option value="support">Supporter</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="5">
				<textarea name="description" style="width: 100%; height: 150px; padding: 10px;" placeholder="So spielt ihr gegen diesen Champion"></textarea>
			</td>
		</tr>
	</table>
	{{ Form::submit('Speichern', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}

@stop