<?php
	$settingsArray = array(); 
?>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&appId=517279855070979&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="sidebar">
	@foreach($global_settings as $setting)
		<?php
			$settingsArray[$setting->key] = $setting->value;  
		?>
	@endforeach
			
			
			
	<!--
	@if($settingsArray['stream_isactive'] === "1")
	<div class="block">
		<h2 class="headline">Livestream</h2>
		<div class="content">
		@if($settingsArray['stream_platform'] === "twitch")
			<iframe src="http://www.twitch.tv/{{$settingsArray['stream_name']}}/embed?auto_play=false&start_volume=2" frameborder="0" scrolling="no" width="360" height="220"></iframe>
		@elseif($settingsArray['stream_platform'] === "hitbox")
			<iframe width="360" height="203" src="http://hitbox.tv/#!/embed/{{$settingsArray['stream_name']}}" frameborder="0" allowfullscreen></iframe>
		@endif
		</div>
	</div>
	@endif
	-->


	@if($settingsArray['stream_isactive'] === "1")
	<div class="block">
		<h2 class="headline">Livestream</h2>
		<div class="content">
		<a href="/stream"><img src="/img/sidebar/stream.png"></a>
		</div>
	</div>
	@endif

    @if(Auth::check())
                <div class="block">
                    <h2 class="headline">Mein Account</h2>
                        {{ Auth::user()->username }} (<a href="/user/edit">Profil bearbeiten</a>)<br/>
                    @if(Auth::user()->hasRole("admin"))
                        <a href="/admin">Admin Panel</a><br/>
                    @endif
                        <a href="/logout" class="logout">Ausloggen</a>
                </div>
        @else
                <div class="block">
                    <h2 class="headline">Login</h2>
                {{ Form::open(array('url' => '/dologin')) }}
                <p>
                    {{ $errors->first('email') }}
                    {{ $errors->first('password') }}
                </p>


                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                    {{ Form::text('email', Input::old('email'), array('placeholder' => 'example@lolquest.net', 'class' => 'form-control')) }}
                </div>
                <br/>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    {{ Form::password('password', array('class' => 'form-control')) }}
                </div>
                <br/>
                <p>{{ Form::submit('Submit!', array('class' => 'btn btn-primary btn-block')) }}</p>
                {{ Form::close() }}
                    <p><a href="/users/create">Noch keinen Account?<br/>
                            Jetzt kostenlos registrieren!</a></p>
                    </div>
    @endif
<!--
	<div class="block">
		<h2 class="headline">Social Media</h2>
		<div class="content" style="text-align: center;">
			<div class="fb-like" data-href="https://www.facebook.com/Flashignitecom" data-width="360" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
			<br/><br/>
			<a href="https://twitter.com/flashignitecom" class="twitter-follow-button" data-show-count="false" data-lang="de" data-size="large">@flashignitecom folgen</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</div>
	</div>-->
	
	
	<div class="block">
		<h2 class="headline">Featured Content</h2>
		<div class="content">
			@foreach($global_featuredContents as $featuredContent)
			<a href="{{ $featuredContent->url }}">
				<div class="featuredContentOuter"><div class="featuredContentInner">{{ $featuredContent->headline }}</div><img src="/uploads/featuredcontent/{{ $featuredContent->destination }}/{{ $featuredContent->filename }}" title="{{ $featuredContent->headline }}" width="100%" /></div>
</a>
			@endforeach
		</div>
	</div>
	<!--
	<div class="block">
		<h2 class="headline">Featured Content</h2>
		<div class="content">
			<p><a href="/news/120/patchnotes-51-basistore-neue-skins-und-vieles-mehr"><img src="/img/sidebar/patch51.png" /></a></p>
			<p><a href="/news/112/alles-uber-lol-esports-im-uberblick"><img src="/img/sidebar/leagues2015.jpg" /></a></p>
			<p><a href="/articles/1/jungle-guide-420"><img src="/img/sidebar/jungle2015.jpg" /></a></p>
		</div>
	</div>-->
	
	
	@if(!Request::is('/'))
	<div class="block">
		<h2 class="headline">Letzte News</h2>
		<div class="content">
			@foreach($global_last_posts as $post)
				<table class="last_news">
					<tr>
						<td valign="top" width="60">
							<a href="/news/{{ $post->id }}/{{ $post->slug }}"><img src="/uploads/news/{{ $post->image }}" width="50" /></a>
						</td>
						<td valign="top">
							<a href="/news/{{ $post->id }}/{{ $post->slug }}"><strong>{{ str_limit($post->title, $limit = 50, $end = '...') }}</strong></a><br/>
							<div class="post_meta">
								{{ $post->created_at->diffForHumans() }}
							</div>
						</td>
					</tr>
				</table>
			@endforeach
		</div>
	</div>
	@endif
	
	<div class="block">
		<h2 class="headline_no_border">Champions und Skins im Angebot</h2>
		<div class="content">
			<table>
				<tr>
					<td valign="top">
						<table class="table table-striped visionward_font">
							<tr>
								<th colspan="2">Champions</th>
							</tr>
						@foreach($global_champion_sales as $champion_sale)
							<tr>
								<td width="30"><a href="/champions/{{ $champion_sale->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $champion_sale->key }}.png" class="img-circle" width="30" /></a></td>
								<td width="150"><a href="/champions/{{ $champion_sale->key }}">{{ $champion_sale->name }}</a></td>
							</tr>
						@endforeach
						</table>
					</td>
					<td width="15"></td>
					<td valign="top">
						<table class="table table-striped visionward_font">
							<tr>
								<th colspan="2">Skins</th>
							</tr>
						@foreach($global_skin_sales as $skin_sale)
							<tr>
								<td width="30"><a href="/champions/{{ $skin_sale->champion->key }}"><img src="http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/champion/{{ $skin_sale->champion->key }}.png" class="img-circle" width="30" /></a></td>
								<td width="150"><a href="/champions/{{ $skin_sale->champion->key }}">{{ $skin_sale->name }}</a></td>
							</tr>
						@endforeach
						</table>
					</td>
				</tr>
			</table>

		</div>
	</div>
	
	
	<div class="block">
		<h2 class="headline_no_border">Pro Spiele</h2>
		<div class="content">
			<table class="table table-striped visionward_font">
			@foreach($global_matches as $match)
				@if($match->parent_game == 0)
				<tr>
					<td width="170"><a href="/matches/{{ $match->id }}"><img src="<?=Croppa::url('/img/teams/logos/'.$match->team->logo, 20, null)?>" height="20" />&nbsp;&nbsp;{{ $match->team->name }}</a></td>
					<td width="20"><a href="/matches/{{ $match->id }}">vs.</a></td>
					<td width="170"><a href="/matches/{{ $match->id }}"><img src="<?=Croppa::url('/img/teams/logos/'.$match->team2->logo, 20, null)?>" height="20" />&nbsp;&nbsp;{{ $match->team2->name }}</a></td>
				</tr>
				@endif
			@endforeach
				<tr>
					<td colspan="3" style="text-align: right;"><a href="/matches" class="red">Zeige alle Spiele</a></td>
				</tr>
			</table>
		</div>
	</div>
	
	
	<div class="block">
		<h2 class="headline_no_border">Spieler Transfers</h2>
		<div class="content">
			<table class="table table-striped visionward_font">
			@foreach($global_transfers as $transfer)
				<tr>
					<td width="120">@if($transfer->player)<a href="/players/{{ $transfer->player->id }}/{{ $transfer->player->nickname }}">{{ $transfer->player->nickname }}</a>@else # @endif</td>
					<td width="120" class="old_team"><a href="/teams/{{ $transfer->oldteam->id }}/{{ $transfer->oldteam->slug }}"><img src="<?=Croppa::url('/img/teams/logos/'.$transfer->oldteam->logo, 20, null)?>" height="20" /><span class="hidden-xs">&nbsp;&nbsp;{{ str_limit($transfer->oldteam->shorthandle, $limit = 10, $end = '...') }}</span></td>
					<td class="new_team" width="120"><a href="/teams/{{ $transfer->team->id }}/{{ $transfer->team->slug }}"><img src="<?=Croppa::url('/img/teams/logos/'.$transfer->team->logo, 20, null)?>" height="20" /><span class="hidden-xs">&nbsp;&nbsp;{{ str_limit($transfer->team->shorthandle, $limit = 10, $end = '...') }}</span></a></td>
				</tr>
			@endforeach
				<tr>
					<td colspan="3" style="text-align: right;"><a href="/transferlist" class="red">Zeige alle Wechsel</a></td>
				</tr>
			</table>
		</div>
	</div>
	
</div>