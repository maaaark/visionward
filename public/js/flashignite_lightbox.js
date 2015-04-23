var already_set_lightbox_content = false;
var animation_speed_lightbox     = 500;

function init__FI_Lightbox(){
	html = '<div id="fi_lightbox_bg" class="fi_lightbox_bg"></div>';
	html += '<div id="fi_lightbox" class="fi_lightbox">';
		html += '<div class="close_btn"></div>';
		html += '<div class="content"></div>';
	html += '</div>';

	$("body").prepend(html);
	already_set_lightbox_content = true;
}

function showLightbox(content, callback){
	if(already_set_lightbox_content == false){
		init__FI_Lightbox();
	}

	if(typeof content != "undefined"){
		$("#fi_lightbox .content").html(content);
	}

	$("#fi_lightbox_bg").show();
	$("#fi_lightbox").show();
	$("#fi_lightbox_bg").animate({"opacity" : "1"}, animation_speed_lightbox, "linear");
	$("#fi_lightbox").animate({"opacity" : "1"}, animation_speed_lightbox, "linear", function(){
		if(typeof callback != "undefined"){
			callback($("#fi_lightbox .content"));
		}
	});

	$("#fi_lightbox_bg").click(function(){
		hideLightbox();
	});

	$("#fi_lightbox .close_btn").click(function(){
		hideLightbox();
	});
}

function hideLightbox(){
	$("#fi_lightbox_bg").animate({"opacity" : "0"}, (animation_speed_lightbox * 0.6), "linear", function(){
		$("#fi_lightbox_bg").hide();
	});

	$("#fi_lightbox").animate({"opacity" : "0"}, (animation_speed_lightbox * 0.6), "linear", function(){
		$("#fi_lightbox").hide();
		$("#fi_lightbox .content").html("");
	});
}