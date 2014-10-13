@extends('layouts.admin')
@section('title', "Admin Panel")
@section('content')
	
	Hallo {{ Auth::user()->first_name }}
	
@stop