$(document).ready(function() {
			var timeout;
			var image = $("#image_status");
			var add_points = $("#points");
			var span = $("#points_span");
			var search = $("#nickname");
			var send = $("#send");
			search.keyup(function (I) {
				switch (I.keyCode) {
					case 13:
					case 27:
					case 38:
					case 40:
						break;
					default:
						var name = search.val();
						name = name.replace(/ +/g, ' ').trim();
						if (name.length === 0) {
							send.fadeOut(200);
							add_points.removeClass('no-click no_bd').addClass('no-nick');
							image.removeClass('fa fa-times');
							image.removeClass('fa fa-check');
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
										image.empty();
										span.val(respone);
										var points = parseInt(span.val());
										if (points >= 0) {
											//no-click
											add_points.removeClass('no-nick').addClass('no-click');
											image.removeClass('fa fa-check').addClass('fa fa-times');
											send.fadeOut(200);
										} else {
											add_points.removeClass('no-click no-nick').addClass('no_bd');
											image.removeClass('fa fa-times').addClass('fa fa-check');
											send.fadeIn(200);
										}
									},
								});
							}, 230);
						}
				}
			});
});