$(document).ready(function() {
	$("#lupa").click(function(){
		
		var playerBuscado = $('#battletagplayer').val();
	    $('.preloader').css('display','block');
	    
	    $.ajax({
	    	method: "GET",
	    	url: "http://www.codeniko.com/index.php?player="+playerBuscado,
	    	success: function(){
	        	$('.preloader').css('display','none');
	    	}
	    });
	    
	});
});