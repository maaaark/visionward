<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="League of Legends, News, eSport, PBE, testserver, Coverage, lcs, world finals, skins, champions">
    <meta name="description" content="Flashignite ist eine deutsche League of Legends Community mit den neusten Informationen vom PBE, der LCS und der eSports Szene">
	<meta name="author" content="Flashignite.com">
    <title>Flashignite.com - @yield('title')</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/css/style.css">

	<link rel="stylesheet" href="/css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="/css/stats/page_index.css">
	<link rel="stylesheet" href="/css/stats/summoner.css">
	<link rel="stylesheet" href="/css/stats/summoner_current_game.css">
	<link rel="stylesheet" href="/css/stats/summoner_matchhistory.css">

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

	<script src="/js/jquery.min.js"></script>
	<script src="/js/jquery.mousewheel.min.js"></script>
	<script src="/js/jquery.mCustomScrollbar.js"></script>
	<script src="/js/jquery.tablesorter.js"></script>
	<script>
		function loadScrollBars(){
		   $(".scroll_bar").mCustomScrollbar({
		      theme:"minimal-dark",
		      scrollInertia:600,
		      autoDraggerLength:false,
		      mouseWheel:{ scrollAmount: 140 }
		   });
		}
	</script>
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

	<div style="padding-top: 50px;">
		@yield('opener')
	</div>

	<div class="container main_content">
		<div class="row">
		  <div class="col-xs-12 col-md-12 main_holder">
			@include('layouts.errors')
			@yield('content')
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

	
	<script type="text/javascript">
    var disqus_shortname = 'flashignite'; // required: replace example with your forum shortname
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
    </script>
    
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