@if($team->id == 57 || $team->id == 59)
<table class="table table-striped">
	@foreach($team->players as $member)
	<tr>
		<td width="120"><strong>
			@if($member->role == "top")
			Top-Lane
			@elseif($member->role == "jungle")
			Jungler
			@elseif($member->role == "mid")
			Mid-Lane
			@elseif($member->role == "adcarry")
			AD-Carry
			@elseif($member->role == "support")
			Supporter
			@endif
		</strong></td>
		<td><img src="/img/flags/{{ $member->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $member->id }}/{{ $member->nickname }}" class="player_tooltip" rel="{{ $member->id }}">{{ $member->nickname }}</a></td>
	</tr>	
	@endforeach				
</table>
@else
<table class="table table-striped">
	<tr>
		<td width="120"><strong>Top-Lane</strong></td>
		@if($top)
		
		<td><img src="/img/flags/{{ $top->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $top->id }}/{{ $top->nickname }}" class="player_tooltip" rel="{{ $top->id }}">{{ $top->nickname }}</a></td>
		@else
		<td>Kein Spieler</td>
		@endif
	</tr>					
	<tr>
		<td width="120"><strong>Jungle</strong></td>
		@if($jungle)
		<td><img src="/img/flags/{{ $jungle->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $jungle->id }}/{{ $jungle->nickname }}"class="player_tooltip" rel="{{ $jungle->id }}">{{ $jungle->nickname }}</a></td>
		@else
		<td>Kein Spieler</td>
		@endif
	</tr>
	<tr>
		<td width="120"><strong>Mid-Lane</strong></td>
		@if($mid)
		<td><img src="/img/flags/{{ $mid->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $mid->id }}/{{ $mid->nickname }}"class="player_tooltip" rel="{{ $mid->id }}">{{ $mid->nickname }}</a></td>
		@else
		<td>Kein Spieler</td>
		@endif
	</tr>
	<tr>
		<td width="120"><strong>AD-Carry</strong></td>
		@if($adc)
		<td><img src="/img/flags/{{ $adc->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $adc->id }}/{{ $adc->nickname }}"class="player_tooltip" rel="{{ $adc->id }}">{{ $adc->nickname }}</a></td>
		@else
		<td>Kein Spieler</td>
		@endif
	</tr>
	<tr>
		<td width="120"><strong>Support</strong></td>
		@if($support)
		<td><img src="/img/flags/{{ $support->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $support->id }}/{{ $support->nickname }}"class="player_tooltip" rel="{{ $support->id }}">{{ $support->nickname }}</a></td>
		@else
		<td>Kein Spieler</td>
		@endif
	</tr>
	<tr>
		<td width="120"><strong>Coach</strong></td>
		@if($coach)
		<td><img src="/img/flags/{{ $coach->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $coach->id }}/{{ $coach->nickname }}" class="player_tooltip" rel="{{ $coach->id }}">{{ $coach->nickname }}</a></td>
		@else
		<td>Nicht bekannt</td>
		@endif
	</tr>
	<tr>
		<td width="120"><strong>Ersatzspieler</strong></td>
		@if($sub)
		<td><img src="/img/flags/{{ $sub->country }}.png" />&nbsp;&nbsp;<a href="/players/{{ $sub->id }}/{{ $sub->nickname }}" class="player_tooltip" rel="{{ $sub->id }}">{{ $sub->nickname }}</a></td>
		@else
		<td>Nicht bekannt</td>
		@endif
	</tr>
</table>
@endif