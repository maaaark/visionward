<h2 class="headline_no_border">Saison 4 Champions</h2>
<table class="table table-striped">
	@foreach($stats as $stat)
	<tr>
		<td valign="top" width="65"><a href="/champions/{{ $stat->champion->name }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $stat->champion->key }}.png" class="img-circle" width="50" /></a></td>
		<td valign="top">
			<strong><a class="black_link" href="/champions/{{ $stat->champion->name }}">{{ $stat->champion->name }}</a></strong>&nbsp;&nbsp;&nbsp;<span class="kda"><span class="games_won">{{ $stat->wins }}</span>/<span class="games_loss">{{ $stat->losses }}</span> 
			(@if($stat->wins != 0 && $stat->losses != 0)
				@if($stat->wins/($stat->wins+$stat->losses)*100>=50)
					{{round($stat->wins/($stat->wins+$stat->losses)*100,2)}}%
				@else
					{{round($stat->wins/($stat->wins+$stat->losses)*100,2)}}%
				@endif
			@endif)
			</span><br/>
			<span class="kda">{{ $stat->creeps }} CS - {{ $stat->kills }} / {{ $stat->deaths }} / {{ $stat->assists }} 
			(@if($stat->deaths != 0)
				{{ round(($stat->kills+$stat->assists)/$stat->deaths, 2) }} 
			@else
				{{ $stat->kills+$stat->assists }} 
			@endif
			KDA)</span>
		</td>
	</tr>
	@endforeach
</table>
<br/>
<h2 class="headline_no_border">Saison 4 Statistik</h2>
<table class="table table-striped">
	<tr>
		<td valign="top" width="150px"><strong>Kills</strong></td>
		<td valign="top">{{number_format($rankedstats->kills , 0 , '.' , '.' )}}</td>
	</tr>
	<tr>
		<td valign="top" width="150px"><strong>Tode</strong></td>
		<td valign="top">{{number_format($rankedstats->deaths , 0 , '.' , '.' )}}</td>
	</tr>
	<tr>
		<td valign="top" width="150px"><strong>Assists</strong></td>
		<td valign="top">{{number_format($rankedstats->assists , 0 , '.' , '.' )}}</td>
	</tr>
	<tr>
		<td valign="top" width="150px"><strong>KDA</strong></td>
		<td valign="top">			
			@if($stat->deaths != 0)
				{{ number_format(($rankedstats->kills+$rankedstats->assists)/$rankedstats->deaths, 2 , ',' , '.' ) }} 
			@else
				{{ number_format($rankedstats->kills+$rankedstats->assists , 0 , ',' , '.' ) }} 
			@endif		
			</td>
	</tr>
	<tr>
		<td valign="top" width="150px"><strong>Versallen</strong></td>
		<td valign="top">{{number_format($rankedstats->creeps , 0 , '.' , '.' )}}</td>
	</tr>
	<tr>
		<td valign="top" width="150px"><strong>Gold</strong></td>
		<td valign="top">{{number_format($rankedstats->gold , 0 , '.' , '.' )}}</td>
	</tr>
	<tr>
		<td valign="top" width="150px"><strong>Schaden gemacht</strong></td>
		<td valign="top">{{number_format($rankedstats->damage , 0 , '.' , '.' )}}</td>
	</tr>
	<tr>
		<td valign="top" width="150px"><strong>Schaden eingesteckt</strong></td>
		<td valign="top">{{number_format($rankedstats->damagetaken , 0 , '.' , '.' )}}</td>
	</tr>
	<tr>
		<td valign="top" width="150px"><strong>Zweifachtötungen</strong></td>
		<td valign="top">{{number_format($rankedstats->doublekills , 0 , '.' , '.' )}}</td>
	</tr>
	<tr>
		<td valign="top" width="150px"><strong>Dreifachtötungen</strong></td>
		<td valign="top">{{number_format($rankedstats->tripplekills , 0 , '.' , '.' )}}</td>
	</tr>
	<tr>
		<td valign="top" width="150px"><strong>Vierfachtötungen</strong></td>
		<td valign="top">{{number_format($rankedstats->quadrakills , 0 , '.' , '.' )}}</td>
	</tr>
	<tr>
		<td valign="top" width="150px"><strong>Fünffachtötungen</strong></td>
		<td valign="top">{{number_format($rankedstats->pentakills , 0 , '.' , '.' )}}</td>
	</tr>
</table>