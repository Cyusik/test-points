var menu = function() {
	$(document).on('click','#hide_menu',function() {
		var hgt = $(".nav-bottom").height();
		hgt = parseInt(hgt);
		//alert(hgt);
		if (hgt === 0) {
			$(".nav-bottom").css('display', 'block');
			$(".nav-bottom").stop().animate({
				height: "205px",
				opacity: 1,
			}, 400, function () {
				$(".nav-bottom").css('height', 'auto');
			});
		} else if(hgt === 10){
			$(".nav-bottom").css('display', 'block');
			$(".nav-bottom").stop().animate({
				height: "205px",
				opacity: 1,
			}, 400, function () {
				$(".nav-bottom").css('height', 'auto');
			});
		} else if(hgt > 200) {
			$(".nav-bottom").stop().animate({
				height: "10px",
				opacity: 1,
			}, 400, function () {
				$(".nav-bottom").css('display', 'none');
			});
		}
	});
}
$(document).ready(menu);