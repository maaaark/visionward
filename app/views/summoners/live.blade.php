@extends('layouts.no_sidebar')
@section('title', $summoner->name)
@section('subtitle', $region)
@section('header_image',"summoner_header.jpg")
@section('content')
<div class="row">
	<div class="col-md-6">
		<!-- BLUE SIDE -->
		<h3 class="blue_indicator">Blaue Seite</h3>
		<table class="live_table" width="100%">
			<tr class="summoner_line">
				<td width="120" style="line-height: 30px;">
					<strong><a href="/summoner/euw/heyitsmark">heyitsmark</a></strong><br/>
				</td>
				<td width="35" style="line-height: 30px;"><img src="http://ddragon.leagueoflegends.com/cdn/5.2.2/img/champion/Rengar.png" alt="Rengar" height="30" class="img-circle" /></td>
				<td width="40">
					<table cellspacing="0" style="" cellpadding="0">
						<tr>
							<td><img src="/img/spells/4.png" width="14" class="img-circle" ></td>
						</tr>
						<tr>
							<td><img src="/img/spells/14.png" width="14" class="img-circle" ></td>
						</tr>
					</table>
				</td>
				<td valign="middle" style="line-height: 30px;"><img src="http://flashignite.com/img/ranked/SILVER_I.png" height="40" /> Silber 1</td>
				<td style="line-height: 30px;"></td>
			</tr>
		</table>
	</div>
	<div class="col-md-6">
		<!-- RED SIDE -->
		<h3 class="red_indicator">Rote Seite</h3>
		<table class="live_table" width="100%">
			<tr class="summoner_line">
				<td width="120" style="line-height: 30px;">
					<strong><a href="/summoner/euw/heyitsmark">heyitsmark</a></strong><br/>
				</td>
				<td width="35" style="line-height: 30px;"><img src="http://ddragon.leagueoflegends.com/cdn/5.2.2/img/champion/Rengar.png" alt="Rengar" height="30" class="img-circle" /></td>
				<td width="40">
					<table cellspacing="0" style="" cellpadding="0">
						<tr>
							<td><img src="/img/spells/4.png" width="14" class="img-circle" ></td>
						</tr>
						<tr>
							<td><img src="/img/spells/14.png" width="14" class="img-circle" ></td>
						</tr>
					</table>
				</td>
				<td valign="middle" style="line-height: 30px;"><img src="http://flashignite.com/img/ranked/SILVER_I.png" height="40" /> Silber 1</td>
				<td style="line-height: 30px;"></td>
			</tr>
		</table>
	</div>
</div>	
@stop

