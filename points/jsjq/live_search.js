$(document).ready(function() {
	var search = $("#search");
	search.focus(function () {
		$("#ul_stop1").stop().animate({
			height: "20px",
			opacity: 1,
		}, 500, function() {
			$("#ul_stop1").add("ul_stop1").css("display", "block");
		});
	});
	search.blur(function() {
		$("#ul_stop1").stop().animate({
			height: "0px",
			opacity: 0,
		}, 500, function() {
		});
	});
	var timeout;
	search.keyup(function (I) {
		switch(I.keyCode) {
			case 13:
			case 27:
			case 38:
			case 40:
				break;
			default:
				var name = $("#search").val();
				name = name.replace(/ +/g, ' ').trim();
				if (name.length === 0) {
					$("#resultdiv_search").val('');
				} else if (name.length > 2) {
					clearTimeout(timeout);
					timeout = setTimeout(function () {
						$.ajax({
							type: "POST",
							url: "/points/script/form_search.php",
							data: {
								search: name
							},
							success: function (respone) {
								$("#resultdiv_search").val(respone).show();
							},
						});
					}, 330);
				}
		}
	});
});