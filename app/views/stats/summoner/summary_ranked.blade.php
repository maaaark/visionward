<div class="summoner_overview_line1">
	<div class="col-md-4 ranked_element">
		<div class="summoner_title"><center>3er Ranked</center></div>
		<div class="holder">
			{if RANKED_TEAM_3X3_NAME}
				<div class="tier_logo" style="background-image:url({DOMAIN}/assets/img/tiers/{RANKED_TEAM_3X3_TIER}_{RANKED_TEAM_3X3_DIVISION}.png);"></div>
				<div class="league">{RANKED_TEAM_3X3_TIER} {RANKED_TEAM_3X3_DIVISION}</div>
				<div class="points">{RANKED_TEAM_3X3_LEAGUE_POINTS} Punkte</div>
				<div class="win_loss wins"><span class="val">{RANKED_TEAM_3X3_WINS}</span> gewonnen</div>
				<div class="win_loss losses"><span class="val">{RANKED_TEAM_3X3_LOSSES}</span> verloren</div>
			{else}
				<div class="tier_logo" style="background-image:url({DOMAIN}/assets/img/tiers/unknown.png);"></div>
				<div class="not_played">Nicht gespielt</div>
			{/if}
		</div>
	</div>
	<div class="col-md-4 ranked_element">
		<div class="summoner_title"><center>Ranked Solo/Duo</center></div>
		<div class="holder">
			{if RANKED_SOLO_5X5_NAME}
				<div class="tier_logo" style="background-image:url({DOMAIN}/assets/img/tiers/{RANKED_SOLO_5X5_TIER}_{RANKED_SOLO_5X5_DIVISION}.png);"></div>
				<div class="league">{RANKED_SOLO_5X5_TIER} {RANKED_SOLO_5X5_DIVISION}</div>
				<div class="points">{RANKED_SOLO_5X5_LEAGUE_POINTS} Punkte</div>
				<div class="win_loss wins"><span class="val">{RANKED_SOLO_5X5_WINS}</span> gewonnen</div>
				<div class="win_loss losses"><span class="val">{RANKED_SOLO_5X5_LOSSES}</span> verloren</div>
			{else}
				<div class="tier_logo" style="background-image:url({DOMAIN}/assets/img/tiers/unknown.png);"></div>
				<div class="not_played">Nicht gespielt</div>
			{/if}
		</div>
	</div>
	<div class="col-md-4 ranked_element">
		<div class="summoner_title"><center>5er Ranked</center></div>
		<div class="holder">
			{if RANKED_TEAM_5X5_NAME}
				<div class="tier_logo" style="background-image:url({DOMAIN}/assets/img/tiers/{RANKED_TEAM_5X5_TIER}_{RANKED_TEAM_5X5_DIVISION}.png);"></div>
				<div class="league">{RANKED_TEAM_5X5_TIER} {RANKED_TEAM_5X5_DIVISION}</div>
				<div class="points">{RANKED_TEAM_5X5_LEAGUE_POINTS} Liga Punkte</div>
				<div class="win_loss wins"><span class="val">{RANKED_TEAM_5X5_WINS}</span> gewonnen</div>
				<div class="win_loss losses"><span class="val">{RANKED_TEAM_5X5_LOSSES}</span> verloren</div>
			{else}
				<div class="tier_logo" style="background-image:url({DOMAIN}/assets/img/tiers/unknown.png);"></div>
				<div class="not_played">Nicht gespielt</div>
			{/if}
		</div>
	</div>
</div>