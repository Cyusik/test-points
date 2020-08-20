$(document).ready(function() {
	var login =  $("#login");
	login.focus(function () {
		$("#ul_stop2").stop().animate({
			height: "83px",
			opacity: 1,
		}, 800, function() {
			$("#ul_stop2").add("ul_stop2").css("display", "block");
		});
	});
	login.blur(function() {
		$("#ul_stop2").stop().animate({
			height: "0px",
			opacity: 0,
		}, 800, function() {
			//$("#ul_stop2").remove();
		});
	});
});