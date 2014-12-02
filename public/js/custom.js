$( document ).ready(function() {

	
		
	var stickyOffset = $('.sticky').offset().top;
	var sticky = $('.sticky'),
		  scroll = $(window).scrollTop();

	  if (scroll >= stickyOffset) {
		sticky.addClass('fixed');
		$("#nav_logo").show();
		$(".main_content").css("margin-top", "0px");
	  } else {
		sticky.removeClass('fixed');
		$("#nav_logo").hide();
		$(".main_content").css("margin-top", "0px");
	  }
	
	$("#show_result").click(function(){
		$(".hidden_result").toggle();
		$("#show_result").hide();
	});
	
	$( ".article a" ).each(function( index ) {
		var link = $(this).attr('href');
		var test = link.split('/');
		if(test[3]=="champions") {
			var value = link.substring(link.lastIndexOf('/')+1);
			var champion_image = $(this).attr('rel');
			var old_text = $(this).text();
			$( this ).html('<img src="http://ddragon.leagueoflegends.com/cdn/4.20.1/img/champion/'+value+'.png" class="img-circle" style="height: 1em;"> '+old_text);
		}
		if(test[3]=="skills") {
			var value = link.substring(link.lastIndexOf('/')+1);
			var id = $(this).attr('rel');
			var old_text = $(this).text();
			var link = $(this);			
			$.getJSON('/skill_tooltip/'+id, function (data) {
				var skill_icon = data.skill.icon; 
				link.html('<img src="http://ddragon.leagueoflegends.com/cdn/4.20.1/img/spell/'+data.skill.icon+'" class="img-circle" style="height: 1em;"> '+data.skill.name);
			});
			
		}
		if(test[3]=="items") {
			var value = link.substring(link.lastIndexOf('/')+1);
			var id = $(this).attr('rel');
			var old_text = $(this).text();
			var link = $(this);
						
			$.getJSON('/item_tooltip/'+id, function (data) {
				link.html('<img src="http://ddragon.leagueoflegends.com/cdn/4.20.1/img/item/'+data.item.id+'.png" class="img-circle" style="height: 1em;"> '+data.item.name);
			});
			
		}
	});

	$('.item_tooltip').tooltipsy({
		alignTo: 'cursor',
		offset: [15, -60],
		content: function ($el, $tip) {
			var active_tooltip = $el.attr('rel');
			$.getJSON('/item_tooltip/'+active_tooltip, function (data) {
				$tip.html(function() { var content = '<div class="info_hover"><table width="500"><tr><td width="90" valign="top"><img src="http://ddragon.leagueoflegends.com/cdn/4.20.1/img/item/'+data.item.id+'.png" class="img-circle" style="margin-bottom: 0px;" width="75" /></td><td valign="top"><table class="table table-striped"><tr><td>'+data.item.name+'</td></tr><tr><td>'+data.item.description+'</td></tr></table></td></tr></table></div>'; return content; }); }); return 'Fallback content'; },
	
	})
	
	$('.skill_tooltip').tooltipsy({
		alignTo: 'cursor',
		offset: [15, -60],
		content: function ($el, $tip) {
			var active_tooltip = $el.attr('rel');
			$.getJSON('/skill_tooltip/'+active_tooltip, function (data) {
				$tip.html(function() { var content = '<div class="info_hover"><table width="500"><tr><td width="90" valign="top"><img src="http://ddragon.leagueoflegends.com/cdn/4.20.1/img/spell/'+data.skill.icon+'" class="img-circle" style="width: 75px;"></td><td valign="top"><table class="table table-striped"><tr><td>'+data.skill.name+'</td></tr><tr><td>'+data.skill.description+'</td></tr></table></td></tr></table></div>'; return content; }); }); return 'Fallback content'; },
	
	})
	
	$('.player_tooltip').tooltipsy({
		alignTo: 'cursor',
		offset: [15, -60],
		content: function ($el, $tip) {
			var active_tooltip = $el.attr('rel');
			$.getJSON('/players_tooltip/'+active_tooltip, function (data) {
				$tip.html(function() { var content = '<div class="info_hover"><table><tr><td valign="top"><img src="/img/players/'+data.player.picture+'" style="margin-bottom: 0px;" width="110" /></td><td valign="top"><table class="table table-striped"><tr><td>Spieler:</td><td><img src="/img/flags/'+data.player.country+'.png" />&nbsp;&nbsp;'+data.player.first_name+' \''+ data.player.nickname + '\' ' + data.player.last_name + '</td></tr><tr><td>Rolle:</td><td>'+data.player.role+'</td></tr><tr><td>Team:</td><td><img src="/img/flags/'+data.team.country+'.png" />&nbsp;&nbsp;'+data.team.name+'</td></tr></table></td></tr></table></div>'; return content; }); }); return 'Fallback content'; },
	
	})
	
	$('.caster_tooltip').tooltipsy({
		alignTo: 'cursor',
		offset: [15, -60],
		content: function ($el, $tip) {
			var active_tooltip = $el.attr('rel');

			$.getJSON('/casters_tooltip/'+active_tooltip, function (data) {
				$tip.html(function() { var content = '<div class="info_hover"><table><tr><td valign="top"><img src="/img/vips/'+data.vip.picture+'" style="margin-bottom: 0px;" width="110" /></td><td valign="top"><table class="table table-striped"><tr><td><strong>Name:</strong></td><td><img src="/img/flags/'+data.vip.country+'.png" />&nbsp;&nbsp;'+data.vip.first_name+' \''+ data.vip.nickname + '\' ' + data.vip.last_name + '</td></tr><tr><td><strong>Aufgabe:</strong></td><td>'+data.vip.task+'</td></tr></table></td></tr></table></div>'; return content; }); }); return 'Fallback content'; },
	})
	
	
	
	$('#champion_tabs a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})
	
	$('.show_ranked_champions').click(function (e) {
	 	e.preventDefault()
		$(".hide_stats").toggle();
		var text = $(".show_ranked_champions").text();
		if(text == "Zeige Top 5 Champions") {
			$(".show_ranked_champions").text("Zeige alle Champions");
		} else {
			$(".show_ranked_champions").text("Zeige Top 5 Champions");
		}
		
	})
	


	$('.toggle_game_details').click( function() {
        $('.game_details-' + $(this).attr('id')).toggle();
		return false;
    });
	
	
	$( ".champion_filter" ).keyup(function() {
		var input = $(this).val().toLowerCase();
		if(input == "") {
			$( ".champion_list li" ).show();
		} else {
			$( ".champion_list li" ).hide();
			$( ".champion_list li[name*='"+input+"']" ).show();
		}
	});




});

