var x = 0;
var y = 0;
$(document).ready(function() {
	$("#add").click(function() {
		if (x < 9) {
			$('#send').fadeIn(200);
			++x;
			y+= 40;
		$("#contests_form").stop().animate({
			height: y + "px",
			opacity: 1,
		}, 500, function() {
		});
			$("#contests_form").append('<div class="nickname_contests" id="nickname_contests_' + x + '">\n' +
				'<input minlength="3" maxlength="21" placeholder="Введите никнейм" class="input" type="text" name="search_contests[]" id="search_contests_' + x + '" required>\n' +
			    '<i class="fa-position" id="image_status_' + x + '" style="font-size:25px; color:white"></i>\n' +
				'<span style="display:none" id="points_contests_' + x + '"></span>\n' +
				'<input style="width:100px; display:none" placeholder="Баллы" class="input" type="number" name="add_points[]" id="add_points_' + x + '" required>\n' +
				'<input style="width:500px; display:none" placeholder="Доп.информация" class="input" type="text" name="cause[]" id="cause_' + x + '" required>\n' +
				'</div>');
		var timeout;
		var cause = $("#cause_" + x);
		var num_points = $("#add_points_" + x);
		var div = $("#nickname_contests_" + x);
		var image = $("#image_status_" + x);
		var span = $("#points_contests_" + x);
		var search = $("#search_contests_" + x);
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
						num_points.val('');
						num_points.fadeOut(100);
						cause.val('');
						cause.fadeOut(100);
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
									if (points) {
										image.removeClass('fa fa-times').addClass('fa fa-check');
										num_points.addClass('no_bd');
										//cause.addClass('in-info');
										num_points.fadeIn(100);
										cause.fadeIn(100);
									} else {
										image.removeClass('fa fa-check').addClass('fa fa-times');
										num_points.val('');
										num_points.fadeOut(100);
										cause.val('');
										cause.fadeOut(100);
									}
								},
							});
						}, 230);
					}
			}
		});
	}
	});
	$("#del").click(function() {
		if (x > 0) {
			y-= 40;
			$("#contests_form").stop().animate({
				height: y + "px",
				opacity: 1,
			}, 500, function() {
			});
			$("#nickname_contests_" + x).html('');
			$("#nickname_contests_" + x).remove();
			--x;
			if(x === 0) {
				$('#send').fadeOut(200);
			}
		}
	});
});