@extends('layouts.small_header')
@section('title', $vip->first_name." '".$vip->nickname."' ".$vip->last_name)
@section('subtitle', $vip->task)
@section('header_image',"vip_header.jpg")
@section('content')
	<table width="100%">
		<tr>
			<td valign="top" width="170"><img src="/img/vips/{{$vip->image}}" class="img-circle" width="150" /></td>
			<td valign="top">
				<table class="table table-striped">
					<tr>
						<td width="120"><strong>Name</strong></td>
						<td><img src="/img/flags/{{ $vip->country }}.png" />&nbsp;&nbsp;{{$vip->first_name}} '{{$vip->nickname}}' {{$vip->last_name}}</td>
					</tr>
					<tr>
						<td><strong>Aufgabe</strong></td>
						<td>{{$vip->task}}</td>
					</tr>
					<tr>
						<td><strong>Twitter</strong></td>
						<td><a href="https://twitter.com/{{$vip->twitter}}">{{$vip->twitter}}</a></td>
					</tr>
					<tr>
						<td><strong>Facebook</strong></td>
						<td><a href="https://www.facebook.com/{{$vip->facebook}}">{{$vip->facebook}}</a></td>
					</tr>
					<tr>
						<td><strong>Summoner</strong></td>
						<td><a href="/summoner/{{$vip->region}}/{{$vip->summoner}}">{{$vip->summoner}}</a></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br/>
	<h2 class="headline">Beschreibung</h2>
	{{ $vip->description }}
	<br/><br/>
	<!--<h2 class="headline_no_border">Events</h2>
	<table class="table table-striped">
		<tr>
			<td>EU LCS</td>
		</tr>
	</table>-->
	<br/>
	<h2 class="headline">Kommentare zu {{ $vip->nickname }}</h2>
	@include('layouts.disqus')
@stop

