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
   <div class="row">
      <div class="col-md-4">
         <h1>Live-Game Infos</h1>
         Hier muss noch ein Text hin
      </div>
      
      <div class="col-md-4">
         <h1>Spielverlauf</h1>
         Hier muss auch noch ein text hin
      </div>
      
      <div class="col-md-4">
         <h1>Ranked Statistiken</h1>
         Hier kommmt auch noch ein Text hin
      </div>
   </div>
   
	<!--<div class="col-md-6">
		<h1>League of Legends News</h1>
		<div class="summoner_stat_news_list">
		@foreach($news_list as $news)
         <div class="news_list_el">
            <table style="width: 100%;">
               <tr>
                  <td class="news_pic"><a href="/news/{{ $news->id }}/{{ $news->slug }}"><img src="<?=Croppa::url('/uploads/news/'.$news->image, null, 50)?>"></a></div>
                  <td class="news_con">
                     <div class="title"><a href="/news/{{ $news->id }}/{{ $news->slug }}">{{ $news->title }}</a></div>
                     <div class="descr">{{ $news->excerpt }}</div>
                  </td>
               </tr>
            </table>
         </div>
		@endforeach
		</div>
	</div>
	<div class="col-md-6">
		<h1>League of Legends News</h1>
		Hier erscheinen ein paar Links zu News
	</div>-->
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