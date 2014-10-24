<h2 class="headline">Gallerie</h2>
<div class="container-fluid header_margin">
		<div class="row">

		  
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  <!-- Wrapper for slides -->
		  <div class="carousel-inner">
		  
		  <img src="/img/header/@yield('header_image', 'header.jpg')">
		  <img src="/img/header/@yield('header_image', 'header.jpg')">
		
		  </div> <!-- end carousel inner -->
	  
	  <!-- Controls -->
	  <a class="left carousel-control" href="#" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left"></span>
	  </a>
	  <a class="right carousel-control" href="#" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right"></span>
	  </a>
	  
		</div>
		<div class="gallery_description">
			{{ $post->gallery->description }}
		</div>
		  
		</div>
	</div>