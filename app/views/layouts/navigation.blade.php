<ul>
	<div class="col-md-8">
		<li id="nav_logo"><a href="/">VISIONWARD</a></li>
		<li {{ Request::is('/') ? ' class="active"' : '' }}{{ Request::is('news/*') ? ' class="active"' : '' }}><a href="/">NEWS</a></li>
		<li {{ Request::is('categories/pbe') ? ' class="active"' : '' }}><a href="/categories/pbe">PBE</a></li>
		<li {{ Request::is('champions/*') ? ' class="active"' : '' }} {{ Request::is('champions') ? ' class="active"' : '' }}><a href="/champions">CHAMPIONS</a></li>
	</div>
	<div class="col-md-4">
	<li style="padding: 0;">
		<div class="searchbox">
			<input type="text" placeholder="Summoner, News, Champion, ..." class="multisearch" />
			<select class="server_region">
				<option value="euw">EU-West</option>
				<option value="eune">EU-NE</option>
				<option value="tr">TR</option>
				<option value="na">NA</option>
			</select>
		</div>
	</li>
	</div>
</ul>