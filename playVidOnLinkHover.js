jQuery(document).ready(function($){ 
	$(".vidLink").hover(function(){
		if ($('#bgvid-1').get(0).paused) {
		$('#bgvid-1').get(0).play();
		} else {
		$('#bgvid-1').get(0).pause();
		}
	});	
});	
