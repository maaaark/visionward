@extends('layouts.design_main')
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
    <h1>{{ $team->name }}</h1>

    <h2 class="headline" style="margin-top: 25px;">Start Roster</h2>
    @foreach($player as $pl)
        @if($pl["is_starter"] == 1)
        <div class="team_player_holder">
            <div class="team_player">
                @if(isset($pl["pic"]) AND trim($pl["pic"]) != "")
                    <div class="pic" style="background-image: url({{ $pl["pic"] }});"></div>
                @else
                    <div class="pic" style="background-image: url(http://riot-web-cdn.s3-us-west-1.amazonaws.com/lolesports/s3fs-public/styles/grid_medium_wide/public/templateSilhoutte_4.jpg);"></div>
                @endif
                <div class="name">
                    {{ $pl["name"] }}
                    <div class="role">{{ $pl["role"] }}</div>
                </div>
            </div>
        </div>
        @endif
    @endforeach
    <div style="clear: both;"></div>

    <h2 class="headline" style="margin-top: 25px;">Ersatzspieler</h2>
    @foreach($player as $pl)
        @if($pl["is_starter"] != 1)
        <div class="team_player_holder">
            <div class="team_player">
                @if(isset($pl["pic"]) AND trim($pl["pic"]) != "")
                    <div class="pic" style="background-image: url({{ $pl["pic"] }});"></div>
                @else
                    <div class="pic" style="background-image: url(http://riot-web-cdn.s3-us-west-1.amazonaws.com/lolesports/s3fs-public/styles/grid_medium_wide/public/templateSilhoutte_4.jpg);"></div>
                @endif
                <div class="name">
                    {{ $pl["name"] }}
                    <div class="role">{{ $pl["role"] }}</div>
                </div>
            </div>
        </div>
        @endif
    @endforeach
    <div style="clear: both;"></div>
@stop