@extends('layouts.header_esports')
@section('title', $team->name)
@section('opener')
    <div class="esports_opener_navi">
        <div class="holder">
            <a href="/esports/{{ str_replace(" ", "_", trim("LCS")) }}">
                <div class="league_icon" style="background-image: url({{ $team->logo_riot }});"></div>
            </a>
            <div class="league_name">
                {{$team->name}}
            </div>
        </div>
    </div>
@stop
@section('content')

    {{ $team->name }}

@stop