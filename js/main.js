$(document).ready(function() {
	$("#lupa").click(function(){
		var player = $('#battletagplayer').val(); //we save the value of battletag input in a variable
	    $('.preloader').css('display','block'); //we display the preloader as soon as they click
	    
	    $.ajax({
	    	method: "GET",
	    	url: "http://www.codeniko.com/index.php?player="+player,
	    	crossDomain: true,
    		dataType: 'jsonp',
	    	success: function(){
	        	$('.preloader').css('display','none'); //once the data is returned, we hide our preloader
	    	}
	    });
	    
	});
});