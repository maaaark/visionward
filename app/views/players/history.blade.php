@extends('layouts.small_header')
@section('title', "Spielertransfer" )
@section('header_image',"pro_teams.jpg")
@section('content')
	
	<h2 class="headline">Spielertransfers</h2>
	<table width="100%" class="table table-striped">
		@foreach($player->history as $history)
		<tr>
			<td><span class="left_team">{{ $history->old_team->name }}</span> -> <span class="joined_team">{{ $history->team->name }}</span></td>
			<td>{{ $history->join_date }}</td>
		</tr>
		@endforeach
	</table>
	
<br/>
	
@stop