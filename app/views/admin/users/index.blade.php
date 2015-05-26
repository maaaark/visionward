@extends('layouts.admin')
@section('title', "Users")
@section('content')
	
	<table class="table table-striped">
			<tr>
				<th>ID</th>
				<th>User</th>
				<th>E-Mail</th>
				<th>Rolle</th>
				<th>Löschen</th>
			</tr>
		@foreach($users as $user)
			<tr>
				<td><a href="/admin/users/edit/{{ $user->id }}">{{ $user->id }}</a></td>
				<td><a href="/admin/users/edit/{{ $user->id }}">{{ $user->username }}</a></td>
				<td><a href="/admin/users/edit/{{ $user->id }}">{{ $user->email }}</a></td>
				<td><a href="/admin/users/edit/{{ $user->id }}">
					@if($user->hasRole("admin"))
						Administrator
					@elseif($user->hasRole("moderator"))
						Moderator
					@else
						User
					@endif
				</a></td>
				<td><a href="/admin/users/delete/{{ $user->id }}" class="delete">Löschen</a></td>
			</tr>
		@endforeach
	</table>
	<a href="/admin/users/create" class="btn btn-primary">Neuen User anlegen</a>
	
@stop