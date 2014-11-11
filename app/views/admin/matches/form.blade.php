{{ Form::hidden('id', Input::old('gallery_id')) }}
<table class="table table-striped">
	<tr>
		<td width="200"><strong>Titel</strong></td>
		<td>{{ Form::text('title', Input::old('title'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Team 1</strong></td>
		<td>
			<select name="team_id_1">
				@if(isset($match))
				<option value="{{ $match->team->id }}">{{ $match->team->name }}</option>	
				@endif
				@foreach($teams as $team)
				<option value="{{ $team->id }}">{{ $team->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
    <tr>
		<td width="200"><strong>Team 1 Top Lane</strong></td>
		<td>
			<select name="team1_top_player">
				@if($match->team1_top_player != 0)
				<option value="{{ $match->team1_top_player }}">{{ $match->team1topplayer->nickname }}</option>	
				@endif
				@foreach($players as $player)
				<option value="{{ $player->id }}">{{ $player->nickname }}</option>
				@endforeach
			</select>
            <select name="team1_top_champion">
				@if($match->team1_top_champion != 0)
				<option value="{{ $match->team1_top_champion }}">{{ $match->team1topchampion->name }}</option>	
				@endif
				@foreach($champions as $champion)
				<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
    <tr>
		<td width="200"><strong>Team 1 Jungle</strong></td>
		<td>
			<select name="team1_jungle_player">
				@if($match->team1_jungle_player != 0)
				<option value="{{ $match->team1_jungle_player }}">{{ $match->team1jungleplayer->nickname }}</option>	
				@endif
				@foreach($players as $player)
				<option value="{{ $player->id }}">{{ $player->nickname }}</option>
				@endforeach
			</select>
            <select name="team1_jungle_champion">
				@if($match->team1_jungle_champion != 0)
				<option value="{{ $match->team1_jungle_champion }}">{{ $match->team1junglechampion->name }}</option>	
				@endif
				@foreach($champions as $champion)
				<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
    <tr>
		<td width="200"><strong>Team 1 Mid Lane</strong></td>
		<td>
			<select name="team1_mid_player">
				@if($match->team1_mid_player != 0)
				<option value="{{ $match->team1_mid_player }}">{{ $match->team1midplayer->nickname }}</option>	
				@endif
				@foreach($players as $player)
				<option value="{{ $player->id }}">{{ $player->nickname }}</option>
				@endforeach
			</select>
            <select name="team1_mid_champion">
				@if($match->team1_mid_champion != 0)
				<option value="{{ $match->team1_mid_champion }}">{{ $match->team1midchampion->name }}</option>	
				@endif
				@foreach($champions as $champion)
				<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
    <tr>
		<td width="200"><strong>Team 1 ADC</strong></td>
		<td>
			<select name="team1_adc_player">
				@if($match->team1_adc_player != 0)
				<option value="{{ $match->team1_adc_player }}">{{ $match->team1adcplayer->nickname }}</option>	
				@endif
				@foreach($players as $player)
				<option value="{{ $player->id }}">{{ $player->nickname }}</option>
				@endforeach
			</select>
            <select name="team1_adc_champion">
				@if($match->team1_adc_champion != 0)
				<option value="{{ $match->team1_adc_champion }}">{{ $match->team1adcchampion->name }}</option>	
				@endif
				@foreach($champions as $champion)
				<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
    <tr>
		<td width="200"><strong>Team 1 Support</strong></td>
		<td>
			<select name="team1_support_player">
				@if($match->team1_support_player != 0)
				<option value="{{ $match->team1_support_player }}">{{ $match->team1supportplayer->nickname }}</option>	
				@endif
				@foreach($players as $player)
				<option value="{{ $player->id }}">{{ $player->nickname }}</option>
				@endforeach
			</select>
            <select name="team1_support_champion">
				@if($match->team1_support_champion != 0)
				<option value="{{ $match->team1_support_champion }}">{{ $match->team1supportchampion->name }}</option>	
				@endif
				@foreach($champions as $champion)
				<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
    
	<tr>
		<td width="200"><strong>Team 2</strong></td>
		<td>
			<select name="team_id_2">
				@if(isset($match))
				<option value="{{ $match->team2->id }}">{{ $match->team2->name }}</option>	
				@endif
				@foreach($teams as $team)
				<option value="{{ $team->id }}">{{ $team->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
    <tr>
		<td width="200"><strong>Team 2 Top Lane</strong></td>
		<td>
			<select name="team2_top_player">
				@if($match->team2_top_player != 0)
				<option value="{{ $match->team2_top_player }}">{{ $match->team2topplayer->nickname }}</option>	
				@endif
				@foreach($players as $player)
				<option value="{{ $player->id }}">{{ $player->nickname }}</option>
				@endforeach
			</select>
            <select name="team2_top_champion">
				@if($match->team2_top_champion != 0)
				<option value="{{ $match->team2_top_champion }}">{{ $match->team2topchampion->name }}</option>	
				@endif
				@foreach($champions as $champion)
				<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
    <tr>
		<td width="200"><strong>Team 2 Jungle</strong></td>
		<td>
			<select name="team2_jungle_player">
				@if($match->team2_jungle_player != 0)
				<option value="{{ $match->team2_jungle_player }}">{{ $match->team2jungleplayer->nickname }}</option>	
				@endif
				@foreach($players as $player)
				<option value="{{ $player->id }}">{{ $player->nickname }}</option>
				@endforeach
			</select>
            <select name="team2_jungle_champion">
				@if($match->team2_jungle_champion != 0)
				<option value="{{ $match->team2_jungle_champion }}">{{ $match->team2junglechampion->name }}</option>	
				@endif
				@foreach($champions as $champion)
				<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
    <tr>
		<td width="200"><strong>Team 2 Mid Lane</strong></td>
		<td>
			<select name="team2_mid_player">
				@if($match->team2_mid_player != 0)
				<option value="{{ $match->team2_mid_player }}">{{ $match->team2midplayer->nickname }}</option>	
				@endif
				@foreach($players as $player)
				<option value="{{ $player->id }}">{{ $player->nickname }}</option>
				@endforeach
			</select>
            <select name="team2_mid_champion">
				@if($match->team2_mid_champion != 0)
				<option value="{{ $match->team2_mid_champion }}">{{ $match->team2midchampion->name }}</option>	
				@endif
				@foreach($champions as $champion)
				<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
    <tr>
		<td width="200"><strong>Team 2 ADC</strong></td>
		<td>
			<select name="team2_adc_player">
				@if($match->team2_adc_player != 0)
				<option value="{{ $match->team2_adc_player }}">{{ $match->team2adcplayer->nickname }}</option>	
				@endif
				@foreach($players as $player)
				<option value="{{ $player->id }}">{{ $player->nickname }}</option>
				@endforeach
			</select>
            <select name="team2_adc_champion">
				@if($match->team2_adc_champion != 0)
				<option value="{{ $match->team2_adc_champion }}">{{ $match->team2adcchampion->name }}</option>	
				@endif
				@foreach($champions as $champion)
				<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
    <tr>
		<td width="200"><strong>Team 2 Support</strong></td>
		<td>
			<select name="team2_support_player">
				@if($match->team2_support_player != 0)
				<option value="{{ $match->team2_support_player }}">{{ $match->team2supportplayer->nickname }}</option>	
				@endif
				@foreach($players as $player)
				<option value="{{ $player->id }}">{{ $player->nickname }}</option>
				@endforeach
			</select>
            <select name="team2_support_champion">
				@if($match->team2_support_champion != 0)
				<option value="{{ $match->team2_support_champion }}">{{ $match->team2supportchampion->name }}</option>	
				@endif
				@foreach($champions as $champion)
				<option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
	<tr>
		<td width="200"><strong>Liga / Turnier</strong></td>
		<td>
			<select name="league_id">
				@if(isset($match))
				<option value="{{ $match->league->id }}">{{ $match->league->name }}</option>	
				@endif
				@foreach($leagues as $league)
				<option value="{{ $league->id }}">{{ $league->name }}</option>
				@endforeach
			</select>
		</td>
	</tr>
	<tr>
		<td width="200"><strong>Best of</strong></td>
		<td>{{ Form::text('bestof', Input::old('bestof'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Punkte Team 1</strong></td>
		<td>{{ Form::text('result_team_1', Input::old('result_team_1'),  array('class' => 'form-control')) }}</td>
	</tr>
	<tr>
		<td width="200"><strong>Punkte Team 2</strong></td>
		<td>{{ Form::text('result_team_2', Input::old('result_team_2'),  array('class' => 'form-control')) }}</td>
	</tr>
	@if(isset($match))
	<tr>
		<td width="200"><strong>Gewinner</strong></td>
		<td>
			<select name="winner_team_id">
				<option value="{{ $match->team->id }}">{{ $match->team->name }}</option>
				<option value="{{ $match->team2->id }}">{{ $match->team2->name }}</option>	
			</select>
		</td>
	</tr>
	@endif
	<tr>
		<td width="200"><strong>Spiel Datum</strong></td>
		<td>{{ Form::text('game_date', Input::old('game_date'),  array('class' => 'form-control')) }}</td>
	</tr>
</table>