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
			$( this ).html('<img src="http://ddragon.leagueoflegends.com/cdn/4.18.1/img/champion/'+value+'.png" class="img-circle" style="height: 1em;"> '+old_text);
		}
	});


	$('.player_tooltip').tooltipsy({
		alignTo: 'cursor',
		offset: [15, 15],
		content: function ($el, $tip) {
			var active_tooltip = $el.attr('rel');

			$.getJSON('/players_tooltip/'+active_tooltip, function (data) {

				$tip.html(function() {
				  var content = '<div class="info_hover"><img src="/img/players/'+data.player.picture+'" style="margin-bottom: 10px;" width="270" /><br/><table class="table table-striped"><tr><td>Spieler:</td><td><img src="/img/flags/'+data.player.country+'.png" />&nbsp;&nbsp;'+data.player.first_name+' \' '+ data.player.nickname + '\' ' + data.player.last_name +  '</td></tr><tr><td>Rolle:</td><td>'+data.player.role+'</td></tr><tr><td>Team:</td><td><img src="/img/flags/'+data.team.country+'.png" />&nbsp;&nbsp;'+data.team.name+'</td></tr></table></div>';
				  return content;
				});
			});
			return 'Fallback content';
		},

	})
	
	$('#champion_tabs a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})
	


	$('.toggle_game_details').click( function() {
        $('.game_details-' + $(this).attr('id')).toggle();
		return false;
    });

});

