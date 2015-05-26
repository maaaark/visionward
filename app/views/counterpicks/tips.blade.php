<div class="row">
  <div class="col-xs-12 col-md-6">
	<h2 class="headline_no_border">Tipps für {{ $champion->name }}</h2>
	<table class="table table-striped">
		
			@if($champion->allytips1)<tr><td>1. {{$champion->allytips1}}</td></tr>@endif
			@if($champion->allytips2)<tr><td>2. {{$champion->allytips2}}</td></tr>@endif
			@if($champion->allytips3)<tr><td>3. {{$champion->allytips3}}</td></tr>@endif
		</tr>
	</table>
  </div>
  <div class="col-xs-12 col-md-6">
	<h2 class="headline_no_border">Tipps gegen {{ $champion->name }}</h2>
	<table class="table table-striped">
			@if($champion->enemytips1)<tr><td>1. {{$champion->enemytips1}}</td></tr>@endif
			@if($champion->enemytips2)<tr><td>2. {{$champion->enemytips2}}</td></tr>@endif
			@if($champion->enemytips3)<tr><td>3. {{$champion->enemytips3}}</td></tr>@endif
	</table>
  </div>
</div>