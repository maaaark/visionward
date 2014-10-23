<ul>
	<div class="col-md-8">
		<li id="nav_logo"><a href="/"><img src="/img/visionward_icon.png" height="35" />&nbsp;&nbsp;VISIONWARD</a></li>
		<li {{ Request::is('/') ? ' class="active"' : '' }}{{ Request::is('news/*') ? ' class="active"' : '' }}><a href="/">NEWS</a></li>
		<li {{ Request::is('categories/esports') ? ' class="active"' : '' }}><a href="/categories/esports">ESPORTS&nbsp;&nbsp;<img src="/img/down.png" width="10"></a>
			<ul class="submenu">
				<li><a href="/teams">PRO TEAMS</a></li>
				<li><a href="/matches">MATCHES</a></li>
				<li style="margin-right: 0px;"><a href="/transferlist">TRANSFERLISTE</a></li>
			</ul>
		</li>
		<li {{ Request::is('categories/pbe') ? ' class="active"' : '' }}><a href="/categories/pbe">RIOT TRACKER</a></li>
		<li {{ Request::is('champions/*') ? ' class="active"' : '' }} {{ Request::is('champions') ? ' class="active"' : '' }}><a href="/champions">CHAMPIONS</a></li>
		<li {{ Request::is('counterpicks/*') ? ' class="active"' : '' }} {{ Request::is('counterpicks') ? ' class="active"' : '' }}><a href="/counterpicks">COUNTERPICKS</a></li>
	</div>
	<div class="col-md-4">
	<li style="padding: 0;">
		<div class="searchbox">
			<input type="text" placeholder="Summoner, News, Champion, ..." class="multisearch" />
			<input type="submit" class="server_region" value="Suchen" />
			<!--<select class="server_region">
				<option value="euw">EU-West</option>
				<option value="eune">EU-NE</option>
				<option value="tr">TR</option>
				<option value="na">NA</option>
			</select>-->
		</div>
	</li>
	</div>
</ul>