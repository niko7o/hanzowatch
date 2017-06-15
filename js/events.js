$(document).ready(function() {
	$("#lupa").click(function(){
		var player = $('#battletagplayer').val(); //we save the value of battletag input in a variable
	    $('.preloader').css('display','block'); //we display the preloader as soon as they click

	    $.ajax({
	    	method: "GET",
	    	crossDomain: true,
	    	contentType: "application/json",
	    	url: 'https://www.codeniko.com/index.php?player='+player,
    		dataType: 'jsonp',
	    	success: function(data){
	        	$('.preloader').css('display','none'); //once the data is returned, we hide our preloader
	    	}
	    });
	});

	$('.open-nav').click(function(){
		$('.open-nav').css('display','none');
		$('.close-nav').css('display','block');		
		
		$("nav div").animate({height: '210px'}, 500);
		$('nav ul li').animate({opacity: "1"}, 150);
	});

	$('.close-nav').click(function(){
		$('.close-nav').css('display','none');
		$('.open-nav').css('display','block');		
		
		$("nav div").animate({height: '0px'}, 500);
		$("nav ul li").animate({opacity: "0"}, 150);

	});

	$('.scrollTop').click(function(){
		$("html, body").animate({ scrollTop: 0 },300,'swing');
	});
});