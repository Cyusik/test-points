var menu = function() {
	$('.hide_menu').click(function() {
		var hgt = $("#accordion li.hide").height();
		hgt = parseInt(hgt);
		if(hgt > 0) {
			$("#accordion li.hide").stop().animate({
				height: "0px",
				opacity: 1,
			}, 500, function() {
				$("#accordion li.hide").css('display', 'none');
			});
		} else {
			$("#accordion li.hide").css('display', 'block');
			$("#accordion li.hide").stop().animate({
				height: "38px",
				opacity: 1,
			}, 500, function() {
			});
		}
	});
}
$(document).ready(menu);