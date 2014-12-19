@extends('layouts.admin')
@section('title', "Admin Panel")
@section('content')
	
	Hallo {{ Auth::user()->first_name }}<br/>
	
	@if(Auth::user()->hasRole("admin"))
		Du hast Administrator Rechte
	@elseif(Auth::user()->hasRole("moderator"))
		Du hast Moderator Rechte
	@endif
	
	@if(Auth::user()->id == 2 || Auth::user()->id == 5)
		<br/><br/>
		<table class="table table-striped">
			@foreach($users as $user)
			<tr>
				<td width="200"><strong>{{ $user->username }}</strong></td>
				<td width="100"><strong>{{ $user->posts->count() }} News</strong></td>
				<td>{{ $user->newscount }} in den letzten 14 Tagen</td>
			</tr>
			@endforeach
		</table>
	@endif
	
@stop