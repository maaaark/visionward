<h2 class="headline_no_border">Meisterschaften</h2>

<div class="masteries_overlay" id="masteries_overlay">
	<div id="masteries_navi" class="masteries_navi"></div>
	<div class="masteries_content">
		<div id="mastery_page_holder"></div>
	</div>
	<div style="clear:both;height:10px;"></div>
</div>

<script>
function loadMasteries(masteries){
	for(i = 0; i < masteries.length; i++){
		if(i == 0){
			$("#masteries_navi").append('<div class="mastery_element open" data-i="'+i+'" data-mastery="'+masteries[i]["id"]+'">'+masteries[i]["name"]+"</div>");
		} else {
			$("#masteries_navi").append('<div class="mastery_element" data-i="'+i+'" data-mastery="'+masteries[i]["id"]+'">'+masteries[i]["name"]+"</div>");
		}
	}
	
	function changeMasteryPage(object){
		$("#mastery_page_holder").html('');
		$("#mastery_page_holder").mastery(object, "http://ddragon.leagueoflegends.com/cdn/{{ $patchversion }}/img/mastery/{MASTERY_ID}.png");
	}

	$("#masteries_overlay #masteries_navi .mastery_element").click(function(){
		if(typeof masteries[$(this).attr("data-i")] != "undefined"){
			$("#masteries_navi .open").removeClass("open");
			$(this).addClass("open");
			changeMasteryPage(masteries[$(this).attr("data-i")]["masteries"]);
		}
	});

	changeMasteryPage(masteries[0]["masteries"]);
}
</script>