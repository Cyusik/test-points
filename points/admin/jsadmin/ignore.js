$(document).ready(function () {
	var timeout;
	var form = $("#ignore_form");
	var image = $("#image_status");
	var span = $("#stat_ignore");
	var search = $("#search_ignore");
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
					$('#add_ignore').remove();
					$('#del_ignore').remove();
					$('#ignore_form button').remove();
					image.removeClass('fa fa-times');
					image.removeClass('fa fa-check');
				} else if (name.length > 2) {
					clearTimeout(timeout);
					timeout = setTimeout(function () {
						$.ajax({
							type: "POST",
							url: "/points/script/ignore_search.php",
							data: {
								search: name
							},
							success: function (respone) {
								image.empty();
								span.val(respone);
								var points = parseInt(span.val());
								if (points >= 0) {
									image.removeClass('fa fa-times').addClass('fa fa-check');
									if(points === 0) {
										$('#del_ignore').remove();
										$('#ignore_form button').remove();
										form.append('<input id="add_ignore" name="st_ignore" form="ignore_form" type="hidden" value="add_ignore"><button id="ignore_click" type="submit" class="button no_bd" style="vertical-align:middle">Добавить в ЧС</button>');
									} else if (points === 1) {
										$('#add_ignore').remove();
										$('#ignore_form button').remove();
										form.append('<input id="del_ignore" name="st_ignore" form="ignore_form" type="hidden" value="del_ignore"><button id="ignore_click" type="submit" class="button no_bd" style="vertical-align:middle">Убрать из ЧС</button>');
									}
								} else {
									image.removeClass('fa fa-check').addClass('fa fa-times');
									$('#add_ignore').remove();
									$('#del_ignore').remove();
									$('#ignore_form button').remove();
								}
							},
						});
					}, 230);
				}
		}
	});
	$('#ignore_form').submit(function(event) {
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#search_ignore').val('');
				$('#ignore_click').remove();
				image.removeClass('fa fa-times');
				image.removeClass('fa fa-check');
				var result = $('#result_ignore');
				result.html(data);
				result.fadeIn();
			},
		});
	});
});