<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/css/admin.css">
	<link rel="shortcut icon" href="/favicon.png" type="image/png">
	<link rel="icon" href="/favicon.png" type="image/png">
    <title>Flashignite Admin Panel - @yield('title')</title>
	<!-- Include Font Awesome -->
	<link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<script src="/js/jquery.min.js"></script>
	<script src="/js/admin.js"></script>
	<script src="/js/ckeditor/ckeditor.js"></script>

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
			<table>
				<tr>
					<td> <a class="navbar-brand" href="#">Flashignite Admin Panel</a></td>
					<td><a class="" href="/">Zur Webseite</a></td>
				</tr>
			</table>
         
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li {{ Request::is('admin') ? ' class="active"' : '' }}><a href="/admin">Dashboard</a></li>
            <li {{ Request::is('admin/news*') ? ' class="active"' : '' }}><a href="/admin/news">News</a></li>
            <li {{ Request::is('admin/categories*') ? ' class="active"' : '' }}><a href="/admin/categories">Kategorien</a></li>
            <li {{ Request::is('admin/galleries*') ? ' class="active"' : '' }}><a href="/admin/galleries">Gallerien</a></li>
			<li {{ Request::is('admin/pictures*') ? ' class="active"' : '' }}><a href="/admin/pictures">Bilder</a></li>
			<li {{ Request::is('admin/sliders*') ? ' class="active"' : '' }}><a href="/admin/sliders">Slider</a></li>
			<li {{ Request::is('admin/teams*') ? ' class="active"' : '' }}><a href="/admin/teams">Teams</a></li>
            <li {{ Request::is('admin/leagues*') ? ' class="active"' : '' }}><a href="/admin/leagues">Ligen</a></li>
			<li {{ Request::is('admin/players*') ? ' class="active"' : '' }}><a href="/admin/players">Spieler</a></li>
            <li {{ Request::is('admin/matches*') ? ' class="active"' : '' }}><a href="/admin/matches">Matches</a></li>
            <li {{ Request::is('admin/placements*') ? ' class="active"' : '' }}><a href="/admin/placements">Platzierungen</a></li>
            <li {{ Request::is('admin/counterpicks*') ? ' class="active"' : '' }}><a href="/admin/counterpicks">Counterpicks</a></li>
			<li {{ Request::is('admin/champions*') ? ' class="active"' : '' }}><a href="/admin/champions">Champions</a></li>
			<li {{ Request::is('admin/skins*') ? ' class="active"' : '' }}><a href="/admin/skins">Skins</a></li>
			<li {{ Request::is('admin/vips*') ? ' class="active"' : '' }}><a href="/admin/vips">VIPs</a></li>
			<li {{ Request::is('admin/users*') ? ' class="active"' : '' }}><a href="/admin/users">User</a></li>
			<li {{ Request::is('admin/settings*') ? ' class="active"' : '' }}><a href="/admin/settings">Einstellungen</a></li>
			<li><a href="/logout">Logout</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">@yield('title')</h1>
			@include('layouts.errors')<br/>
			@yield('content')

        </div>
      </div>
    </div>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-51337940-3', 'auto');
	  ga('send', 'pageview');

	</script>
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>