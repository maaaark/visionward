
<h2 class="headline">Gallerie</h2>

		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  <!-- Wrapper for slides -->
		  <div class="carousel-inner">
		 <?php $i=0; ?>
		 @foreach($post->gallery->pictures as $image)
		  @if($i==0)
		 	 <div class="item active">
		 	 <?php $i++; ?>
		 @else
		 	 <div class="item">
		 @endif
				<div class="">
					<img src="/uploads/galleries/{{ $image->destination }}/{{ $image->filename }}" width="100%" />
				</div>
		  </div>
		  @endforeach
		  
		</div> <!-- end carousel inner -->
  	  
	  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
  	    <span class="glyphicon glyphicon-chevron-left"></span>
  	  </a>
  	  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
  	    <span class="glyphicon glyphicon-chevron-right"></span>
  	  </a>
	  
	</div>		  

		<div class="gallery_description">
			{{ $post->gallery->description }}
		</div>		  