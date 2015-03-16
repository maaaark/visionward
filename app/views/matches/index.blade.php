@extends('layouts.no_sidebar')
@section('title', "Die nächsten Profi Spiele")
@section('subtitle', "Professionelle League of Legends Spiele in der Übersicht")
@section('header_image',"pro_teams.jpg")
@section('content')


<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-4">
    
      <h2 class="headline_no_border">Europäische LCS</h2>
    <table width="100%" class="table table-striped">
	@foreach($eulcs as $match)
	<tr>
		<td width="75">
			<a href="/matches/{{ $match->id }}"><img src="/img/teams/logos/{{ $match->team->logo }}" height="20" /><span class="hidden-xs hidden-sm"> {{ $match->team->shorthandle }}</span></a>
		</td>
		<td width="30">
			vs.
		</td>
		<td width="75">
			<a href="/matches/{{ $match->id }}"><img src="/img/teams/logos/{{ $match->team2->logo }}" height="20" /><span class="hidden-xs hidden-sm"> {{ $match->team2->shorthandle }}</span></a>
		</td>
		<td width="30">
			<a href="/leagues/{{ $match->league->id }}/{{ $match->league->slug }}"><img src="/img/teams/{{ $match->league->logo }}" height="20" /></a>
		</td>
		<td>
			@if($match->game_date >= date('Y-m-d H:i:s'))
				<a href="/matches/{{ $match->id }}">{{ date("d.m - H:i",strtotime($match->game_date)) }} Uhr</a>
			@else
				@if($match->winner_team_id == 0)
					<a href="/matches/{{ $match->id }}">Live</a>
				@else
					<a href="/matches/{{ $match->id }}">Zeige Ergebnis</a>
				@endif
			@endif
		</td>
	</tr>
	@endforeach
</table>
      
  </div>
  <div class="col-xs-12 col-sm-12 col-md-4">
    <h2 class="headline_no_border">Nordamerikanische LCS</h2>
  <table width="100%" class="table table-striped">
	@foreach($nalcs as $match)
	<tr>
		<td width="75">
			<a href="/matches/{{ $match->id }}"><img src="/img/teams/logos/{{ $match->team->logo }}" height="20" /><span class="hidden-xs hidden-sm"> {{ $match->team->shorthandle }}</span></a>
		</td>
		<td width="30">
			vs.
		</td>
		<td width="75">
			<a href="/matches/{{ $match->id }}"><img src="/img/teams/logos/{{ $match->team2->logo }}" height="20" /><span class="hidden-xs hidden-sm"> {{ $match->team2->shorthandle }}</span></a>
		</td>
		<td width="30">
			<a href="/leagues/{{ $match->league->id }}/{{ $match->league->slug }}"><img src="/img/teams/{{ $match->league->logo }}" height="20" /></a>
		</td>
		<td>
			@if($match->game_date >= date('Y-m-d H:i:s'))
				<a href="/matches/{{ $match->id }}">{{ date("d.m - H:i",strtotime($match->game_date)) }} Uhr</a>
			@else
				@if($match->winner_team_id == 0)
					<a href="/matches/{{ $match->id }}">Live</a>
				@else
					<a href="/matches/{{ $match->id }}">Zeige Ergebnis</a>
				@endif
			@endif
		</td>
	</tr>
	@endforeach
</table>
    
  </div>
    
  <div class="col-xs-12 col-sm-12 col-md-4">
    <h2 class="headline_no_border">Challenger + diverse</h2>
  <table width="100%" class="table table-striped">
	@foreach($others as $match)
	<tr>
		<td width="85">
			<a href="/matches/{{ $match->id }}"><img src="/img/teams/logos/{{ $match->team->logo }}" height="20" /><span class="hidden-xs hidden-sm"> {{ $match->team->shorthandle }}</span></a>
		</td>
		<td width="30">
			vs.
		</td>
		<td width="85">
			<a href="/matches/{{ $match->id }}"><img src="/img/teams/logos/{{ $match->team2->logo }}" height="20" /><span class="hidden-xs hidden-sm"> {{ $match->team2->shorthandle }}</span></a>
		</td>
		<td width="30">
			<a href="/leagues/{{ $match->league->id }}/{{ $match->league->slug }}"><img src="/img/teams/{{ $match->league->logo }}" height="20" /></a>
		</td>
		<td>
			@if($match->game_date >= date('Y-m-d H:i:s'))
				<a href="/matches/{{ $match->id }}">{{ date("d.m - H:i",strtotime($match->game_date)) }} Uhr</a>
			@else
				@if($match->winner_team_id == 0)
					<a href="/matches/{{ $match->id }}">Live</a>
				@else
					<a href="/matches/{{ $match->id }}">Zeige Ergebnis</a>
				@endif
			@endif
		</td>
	</tr>
	@endforeach
</table>
    
  </div>
    
</div>
<br/>

@stop