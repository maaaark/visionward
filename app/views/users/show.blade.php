@extends('layouts.small_header')
@section('title', $user->username)
@section('subtitle', $user->first_name." ".$user->last_name)
@section('content')

<table width="100%">
	<tr>
		<td width="170" valign="top">
			<img width="150" src="/img/team/{{ $user->image }}" class="img-circle">
		</td>
		<td valign="top">
			<table width="100%" class="table table-striped">
				<tr>
					<td width="110"><strong>Name</strong></td>
					<td>{{ $user->first_name }} {{ $user->last_name }}</td>
				</tr>
				<tr>
					<td width="110"><strong>Summoner</strong></td>
					<td>{{ $user->username }}</td>
				</tr>
				<tr>
					<td width="110"><strong>Aufgabe</strong></td>
					<td>{{ $user->task }}</td>
				</tr>
				<tr>
					<td width="110"><strong>Beschreibung</strong></td>
					<td>{{ $user->description }}</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<h2 class="headline">Gästebuch</h2>
@include("layouts.disqus")
@stop