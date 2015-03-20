@extends('stats.header')
@section('opener')
	<div class="index_search_layer">
		<div class="search_box">
			<div class="search_title">Suche:</div>
			<form action="#" method="get" class="search_box_form">
				<input type="text" name="summoner" class="search_input" placeholder="Champ oder Beschw&ouml;rer suchen" data-searchid="index_form">
				<div class="search_dropdown">
		         <div class="search_dropdown_current">EUW</div>
		         <div class="search_dropdown_options">
		            <div class="element">EUW</div>
		            <div class="element">NA</div>
		         </div>
		      </div>
				<button class="search_button">Suchen</button>
				<div id="index_form_autocomplete" class="search_autocomplete"></div>
			</form>
		</div>
	</div>
@stop

@section('content')
	<div class="col-md-6">
		<h1>Champions</h1>
		{CHAMPIONS_LIST(44,true,index_list)}
		<div style="padding:8px;text-align:center;"><a href="/champions">Alle Champions anzeigen</a></div>
	</div>
	<div class="col-md-6">
		<h1>League of Legends News</h1>
		Hier erscheinen ein paar Links zu News
	</div>
	<div style="margin-top:35px;clear:both;"></div>
	
	<div class="col-md-4">
		<h2>Champions und Skins im Angebot</h2>
		Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
	</div>
	
	<div class="col-md-4">
		<h2>&Uuml;ber LoL-Stats</h2>
		Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
	</div>
	
	<div class="col-md-4">
		<h2>Wie funkioniert das alles?</h2>
		Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
	</div>

	<script>
		$(document).ready(function(){
		   $(".search_dropdown").hover(
		      function(){
		         element = $(this).find(".search_dropdown_options");
		         element.show();
		      },
		      function(){
		         element = $(this).find(".search_dropdown_options");
		         element.hide();
		      }
		   );
		   
		   $(".search_dropdown").click(function(){
		      element = $(this).find(".search_dropdown_options");
		      element.toggle();
		   });
		   
		   $(".search_dropdown .search_dropdown_options .element").click(function(){
		      dropdown = $(this).parent().parent();
		      dropdown.find(".search_dropdown_current").html($(this).html());
		   });
		   
		   $(".search_box_form").submit(function(event){
				event.preventDefault();
		      main   = $(this).parent();
		      input  = main.find(".search_input");
		      region = main.find(".search_dropdown_current");
				
				if(input.val().trim() != ""){
					self.location.href = domain+'/summoner/'+region.html().trim().toLowerCase()+"/"+input.val().trim();
				}
		   });
	   });
	</script>
@stop