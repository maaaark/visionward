<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>visonward.net - @yield('title')</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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

	<div class="container main_content">
		<div class="row">
		  <div class="col-xs-12 col-md-8">
			@include('layouts.errors')
			@yield('content')
		  </div>
		  <div class="col-xs-12 col-md-4">
			@include('layouts.sidebar')
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
    var disqus_shortname = 'heyitsmark'; // required: replace example with your forum shortname
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
    </script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
	<script src="/js/custom.js"></script>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-51337940-3', 'auto');
  ga('send', 'pageview');

</script>
  </body>
</html>