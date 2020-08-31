//----------заявки для обмена---------
//----------Добавление строки---------
$(document).ready(function() {
	$('#addexchange').submit(function(event) {
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultdiv5').html(data);
				$('#nicknames').val('');
				$('#login').val('');
				$('#prizes').val('');
				$('#points').val('');
			},
		});
	});
});

//----------поиск по нику-----
$(document).ready(function() {
	$('#poiskobmennick').submit(function(event) {
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultdiv1').html(data);
				$('#obmennick').val('');
			},
		});
	});
});

//----------вывод всех-----
$(document).ready(function() {
	$('#poiskall').submit(function(event) {
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultdiv2').html(data);
			},
		});
	});
});