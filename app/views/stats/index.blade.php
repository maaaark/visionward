@extends('layouts.design_main')
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
	<div class="row" style="margin-top: 30px;">
		<div class="col-md-6 no_mobile">
			<img src="{{ url('img/stats/live_game_preview.jpg') }}" style="width: 100%;">
		</div>
		<div class="col-md-6">
			<div style="height: 30px;" class="no_mobile"></div>
			<h2 class="headlin">Live-Game Preview</h2>
			Erhalte einen detaillierten Einblick in das gegnerische Team.<br/>
			Gebe einfach einen Beschw&ouml;rernamen in die Suche ein und nach wenigen Sekunden
			stehen dir genaue Informationen wie Runen, Meisterschaften, Liga-Daten uvm. &uuml;ber<br/>
			Mitspieler und Gegner zur Verf&uuml;gung.<br/>
			<br/>
			<b>Die Elo:</b><br/>
			Desweiteren wird f&uuml;r jeden Beschw&ouml;rer und jedes Team die aktuelle Elo errechnet.
			Diese ergibt sich aus der aktuellen Liga-Position, der Anzahl der gespielten Spiele und noch
			einigen anderen Faktoren.
		</div>
	</div>

	<div class="row left_on_mobile" style="margin-top: 30px;">
		<div class="col-md-6">
			<div style="height: 30px;" class="no_mobile"></div>
			<h2 class="headlin">Ranglisten-Stats</h2>
			Erhalte live Statistiken wie Durchschnittswerte, Win-/Playrates uvm. direkt in deinem Summoner-Profil.
			Bei jeder aktualisierung deines Summoners werden deine Statistiken neu ermittelt und berechnet.<br/>
			Desweiteren hast du die Möglichkeit deine Runen- und Meisterschaftsseiten kinderleicht mit anderen
			Summonern vergleichen.<br/>
			<br/>
			&Uuml;ber deinen Spielverlauf kommst du zu Team-Mitgliedern und Gegnern von deinen letzten Spielen,
			um zum Beispiel genaueres &uuml;ber deren Builds, Runen, Meisterschaften o.&auml;. zu erfahren.
		</div>
		<div class="col-md-6 no_mobile">
			<img src="{{ url('img/stats/ranked_data_preview.jpg') }}" style="width: 100%;">
		</div>
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
					self.location.href = '/'+region.html().trim().toLowerCase()+"/"+input.val().trim();
				}
		   });
	   });
	</script>
@stop