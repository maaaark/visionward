<div class="visible-xs-* visible-sm-* hidden-md hidden-lg">
	<ul>
		<li><a href="http://{{ MAIN_URL }}"><img src="/img/flashignite_logo.png" height="35" style="margin-top: -6px;" /> FLASHIGNITE</a></li>
		<li>
			<a href="#"><span class="glyphicon glyphicon-align-justify"></span></a>
			<ul class="submenu_mobile">
				<li><a href="http://{{ MAIN_URL }}">News</a></li>
				<li><a href="#">GUIDES&nbsp;&nbsp;<img src="/img/down.png" width="10"></a>
					<ul class="sub_submenu_mobile">
						<li><a href="http://{{ MAIN_URL }}/articles/1/jungle-guide-420">SEASON 5 JUNGLE</a></li>
						<li><a href="http://{{ MAIN_URL }}/matches">VIDEOS</a></li>
					</ul>
				</li>
				<li><a href="http://{{ MAIN_URL }}/esports">ESPORTS&nbsp;&nbsp;<img src="/img/down.png" width="10"></a>
					<ul class="sub_submenu_mobile">
						<!--<li><a href="http://{{ MAIN_URL }}/teams">PRO TEAMS</a></li>-->
						<!--<li><a href="/vips">CASTER / HOSTS</a></li>-->
						<li><a href="http://{{ MAIN_URL }}/esports/#matches">MATCHES</a></li>
						<li><a href="http://{{ MAIN_URL }}/esports/#leagues">LIGEN</a></li>
						<!--<li><a href="http://{{ MAIN_URL }}/transferlist">TRANSFERLISTE</a></li>-->
					</ul>
				</li>
				<li><a href="http://{{ MAIN_URL }}/categories/pbe">PBE</a></li>
				<li><a href="http://{{ MAIN_URL }}/champions">CHAMPIONS</a></li>
				<li><a href="http://{{ MAIN_URL }}/counterpicks">KONTERPICKS</a></li>
			</ul>
		</li>
		<li><a href="#"><span class="glyphicon glyphicon-search"></span></a></li>
	</ul>
</div>

	<div class="col-md-8" style="padding-left: 0; margin-left: 0;">
        <ul class="hidden-xs hidden-sm">
		<li id="nav_logo"><a href="http://{{ MAIN_URL }}/"><img src="/img/flashignite_logo.png" height="35" style="margin-top: -6px;" /> FLASHIGNITE</a></li>
		<li {{ Request::is('/') ? ' class="active"' : '' }}{{ Request::is('news/*') ? ' class="active"' : '' }}><a href="http://{{ MAIN_URL }}/">NEWS</a></li>
		<li {{ Request::is('guides') ? ' class="active"' : '' }}><a href="#">GUIDES&nbsp;&nbsp;<img src="/img/down.png" width="10"></a>
			<ul class="submenu">
				<li><a href="http://{{ MAIN_URL }}/articles/1/jungle-guide-420">SEASON 5 JUNGLE</a></li>
				<li><a href="http://{{ MAIN_URL }}/categories/videos">VIDEOS</a></li>
			</ul>
		</li>
		<li {{ Request::is('/esports*') ? ' class="active"' : '' }}><a href="http://{{ MAIN_URL }}/esports">ESPORTS&nbsp;&nbsp;<img src="/img/down.png" width="10"></a>
			<ul class="submenu">
				<!--<li><a href="http://{{ MAIN_URL }}/teams">PRO TEAMS</a></li>-->
				<!--<li><a href="/vips">CASTER / HOSTS</a></li>-->
				<li><a href="http://{{ MAIN_URL }}/esports/#matches">MATCHES</a></li>
				<li style="margin-right: 0px;"><a href="/esports/#leagues">LIGEN</a></li>
			</ul>
		</li>
		<li {{ Request::is('categories/pbe') ? ' class="active"' : '' }}><a href="http://{{ MAIN_URL }}/categories/pbe">PBE</a></li>
		<li {{ Request::is('champions/*') ? ' class="active"' : '' }} {{ Request::is('champions') ? ' class="active"' : '' }}><a href="http://{{ MAIN_URL }}/champions">CHAMPIONS</a></li>
		<li {{ Request::is('counterpicks/*') ? ' class="active"' : '' }} {{ Request::is('counterpicks') ? ' class="active"' : '' }}><a href="http://{{ MAIN_URL }}/counterpicks">KONTERPICKS</a></li>
		<li><a href="http://summoner.{{ MAIN_URL }}/">BESCHW&Ouml;RER</a></li>
	    </ul>
    </div>
	<div class="col-md-4">
    <ul class="hidden-xs hidden-sm right_navigation">
        <li>
            @if(Auth::check())
                <span class="badge" style="margin-right: 10px;">Level {{ Auth::user()->userlevel->level }}</span>
                <span style="width: 100%; text-align: center;">{{ round(((Auth::user()->exp - Auth::user()->userlevel->start_exp)/Auth::user()->userlevel->end_exp)*100,2) }}% ({{ Auth::user()->exp - Auth::user()->userlevel->start_exp }}/{{ Auth::user()->userlevel->end_exp }} EXP)</span>
                <!--<div class="progress-bar" role="progressbar" aria-valuenow="{{((Auth::user()->exp - Auth::user()->userlevel->start_exp)/Auth::user()->userlevel->end_exp)*100}}" aria-valuemin="0" aria-valuemax="100" style="width: {{((Auth::user()->exp - Auth::user()->userlevel->start_exp)/Auth::user()->userlevel->end_exp)*100}}%;"></div>
            -->
            @endif

            @if(Auth::check())
                <ul class="sub_submenu" style="">
                    <li style="width: 100%;">
                        <a style="padding: 0px; padding-left: 10px;" href="http://summoner.flashignite.com/{{ Auth::user()->summoner->region }}/{{ Auth::user()->summoner->name }}">
                            <img width="35" height="35" src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/profileicon/{{ Auth::user()->summoner->profileIconId }}.png" class="img-circle" alt="{{ Auth::user()->summoner->name }}" />
                            @if(isset(Auth::user()->summoner->solo_tier) AND Auth::user()->summoner->solo_tier AND trim(Auth::user()->summoner->solo_tier) != "none")
                                <img width="35" height="35" src="http://summoner.flashignite.com/img/stats/tiers/{{ Auth::user()->summoner->solo_tier }}_I.png" alt="">
                            @endif
                            <span style="padding-left: 3px;">Profil</span>
                        </a>
                    </li>
                    <!-- <li><a href="/einstellungen">Einstellungen</a></li> -->
                    @if(Auth::user()->hasRole("admin"))
                        <li style="width: 100%;"><a href="http://{{ MAIN_URL }}/admin">Admin Panel</a></li>
                    @endif
                    <li style="width: 100%;"><a href="http://{{ MAIN_URL }}/logout">Ausloggen</a></li>
                </ul>
            @else
                <a href="http://{{ MAIN_URL }}/login">LOGIN</a>
            @endif
        </li>
        @if(!Auth::check())
            <li><a href="http://{{ MAIN_URL }}/register">REGISTRIEREN</a></li>
        @endif
        <li>

        </li>
        <li>
            <a href="#">SUCHE</a>
            <ul class="submenu">
                <li style="height: 55px;">
                    <div class="searchbox">
                        <form action="http://{{ MAIN_URL }}/search" method="post">
                            <input type="text" placeholder="Summoner, News, Champion, ..." class="multisearch" name="search" />
                            <input type="submit" class="search_button" value="Suchen" />
                            <select class="server_region" name="server_region">
                                <option value="euw">EU-West</option>
                                <option value="eune">EU-NE</option>
                                <option value="tr">TR</option>
                                <option value="na">NA</option>
                            </select>
                        </form>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
	</div>