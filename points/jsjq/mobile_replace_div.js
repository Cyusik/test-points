var isMobile = false;
$(document).ready( function() {
	if ($('body').width() <= 460) {
		isMobile = true;
	}
	if (isMobile) { //mobile
		$(function (){
			var left_cont = $('#left');
			var right_cont = $('#right');
			left_cont.replaceWith(right_cont.clone());
			right_cont.replaceWith(left_cont);
		});
	}
});