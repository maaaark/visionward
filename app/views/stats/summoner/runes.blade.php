<h1>Runen</h1>
<div id="runes_msg"></div>
<div class="runes_holder" id="runes_holder">
	<div id="runes_navi" class="runes_navi"></div>
	<div class="runes_content">
		<div style="float:left;" class="runes_book_holder">
			<div id="rune_page_holder"></div>
		</div>
		<div class="rune_info_holder">
			<div id="rune_page_info" class="rune_page_info">
				<div class="rune_page_name"><h2 style="margin-top:0px;">Runenseite: <span id="rune_page_name"></span></h2></div>
				<div id="rune_page_content"></div>
			</div>
		</div>
	</div>
	<div style="clear:both;height:10px;"></div>
</div>

<script>
	function loadRunes(runes){
		if(typeof runes[0]["slots"] == "undefined"){
			$("#runes_msg").html('<div class="no_runes">{NAME} hat noch keine Runenseiten erstellt.</div>');
			$("#runes_holder").remove();
		} else {
			// Runenseiten laden
			for(i = 0; i < runes.length; i++){
				if(i == 0){
					$("#runes_navi").append('<div class="rune_element open" data-i="'+i+'" data-runepage="'+runes[i]["id"]+'">'+runes[i]["name"]+"</div>");
				} else {
					$("#runes_navi").append('<div class="rune_element" data-i="'+i+'" data-runepage="'+runes[i]["id"]+'">'+runes[i]["name"]+"</div>");
				}
			}
		
			function changeRunePage(object){
				$("#rune_page_info #rune_page_name").html(object["name"]);
				runes_temp = [];
				for(i = 0; i < object["slots"].length; i++){
					element = object["slots"][i];
					if(typeof runes_temp[element["runeId"]] == "undefined"){
						runes_temp[element["runeId"]] = [];
						runes_temp[element["runeId"]]["element"] = element;
						runes_temp[element["runeId"]]["count"] = 1;
					} else {
						runes_temp[element["runeId"]]["element"] = element;
						runes_temp[element["runeId"]]["count"]++;
					}
					console.log(element);
				}
			
				$("#rune_page_content").html("");
				for(var key in runes_temp) {
					html  = "<div class='rune_info_element'>";
					html += "<img src='http://counterpick.de/uploads/runes/"+key+"_icon.png'>"+runes_temp[key]["count"]+"x "+runes_temp[key]["element"]["name"]+'<br>';
					html += "<span class='rune_desc'>"+runes_temp[key]["element"]["description"]+"</span>";
					html += "</div>";
					$("#rune_page_content").append(html);
				}
				$("#rune_page_holder").runepage(object["slots"], "http://counterpick.de/uploads/runes/{RUNE_ID}_icon.png");
			}
		
			changeRunePage(runes[0]);
		
			$(".rune_element").click(function(){
				$("#runes_navi .open").removeClass("open");
				$(this).addClass("open");
				for(i = 0; i < runes.length; i++){
					if(runes[i]["id"] == $(this).attr("data-runepage")){
						changeRunePage(runes[i]);
						break;
					}
				} 
			});
		}
	}
</script>