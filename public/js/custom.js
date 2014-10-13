$( document ).ready(function() {

	
	var stickyOffset = $('.sticky').offset().top;
	var sticky = $('.sticky'),
		  scroll = $(window).scrollTop();

	  if (scroll >= stickyOffset) {
		sticky.addClass('fixed');
		$("#nav_logo").show();
		$(".main_content").css("margin-top", "80px");
	  } else {
		sticky.removeClass('fixed');
		$("#nav_logo").hide();
		$(".main_content").css("margin-top", "0px");
	  }
	

	$(window).scroll(function(){
	  var sticky = $('.sticky'),
		  scroll = $(window).scrollTop();

	  if (scroll >= stickyOffset) {
		sticky.addClass('fixed');
		$("#nav_logo").show();
		$(".main_content").css("margin-top", "80px");
	  } else {
		sticky.removeClass('fixed');
		$("#nav_logo").hide();
		$(".main_content").css("margin-top", "0px");
	  }
	  
	});



});