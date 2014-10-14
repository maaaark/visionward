@extends('layouts.admin')
@section('title', "Admin Panel")
@section('content')
	
	Hallo {{ Auth::user()->first_name }}<br/>
	
	@if(Auth::user()->hasRole("admin"))
		Du hast Administrator Rechte
	@elseif(Auth::user()->hasRole("moderator"))
		Du hast Moderator Rechte
	@endif
	
@stop