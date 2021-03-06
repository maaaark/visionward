<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="League of Legends, News, eSport, PBE, testserver, Coverage, lcs, world finals, skins, champions">
    <meta name="description" content="Flashignite ist eine deutsche League of Legends Community mit den neusten Informationen vom PBE, der LCS und der eSports Szene">
	<meta name="author" content="Mark Tomicki">
    <title>Flashignite.com - @yield('title')</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/css/feedback.min.css" />
	<link rel="shortcut icon" href="/favicon.png" type="image/png">
	<link rel="icon" href="/favicon.png" type="image/png">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<meta property="og:title" content="@yield('title')" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="Flashignite" />
	<meta property="og:url" content="{{ Request::url() }}" />
	@if(isset($post))
	<meta property="og:image" content="{{URL::to('/')}}/uploads/news/{{$post->image}}" />
	@endif
  </head>
  <body>
	
	<div class="container-fluid">
		<div class="sticky">
			<div class="row">
				<div class="navigation">
					<div class="container">
					@include('layouts.navigation')
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
	<div class="header_margin hidden-xs hidden-sm">
		<div class="row">
		  <div class="col-md-12 item small_header" style="background: url(/img/header/@yield('header_image', 'small_header.jpg'));">
			<div class="container">
				<span class="headline_background">
					<h2 class="page_title">@yield('title')</h2>
					<div class="header_subline">@yield('subtitle')</div>
				</span>
			</div>
		  </div>
		</div>
	</div>
	</div>
	<br/>
	<div class="container main_content">
		<div class="row">
		  <div class="col-xs-12 col-md-8">
			@include('layouts.errors')
			<div class="visible-xs-* visible-sm-* hidden-md hidden-lg header_margin">
				<br/>
				<h2 class="mobile_page_title">@yield('title')</h2>
				<div class="mobile_header_subline">@yield('subtitle')</div>
				<br/>
			</div>
			@yield('content')
		  </div>
		  <div class="col-xs-12 col-md-4">
			@include('layouts.summoner_sidebar',  array('stats' => $stats, 'rankedstats' => $rankedstats, 'summoner' => $summoner))
		  </div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
		  <div class="col-md-12 footer">
			  	<div class="container">
				@include('layouts.footer')
			</div>
		  </div>
		</div>
	</div>

	
	@include('layouts.disqus');
    
    <script src="/js/jquery.min.js"></script>
	<script src="/js/tooltipsy.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
	<script src="/js/custom.js"></script>
	<script src="/js/feedback.min.js"></script>
	<script type="text/javascript">
	        $.feedback({
	            ajaxURL: '/feedback',
	            html2canvasURL: '/js/html2canvas.min.js'
	        });
	    </script>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-51337940-3', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>
  </body>
</html>