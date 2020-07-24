//----------Импорт баллов--------------------
//----------Добавление строки ник/баллы/история--------
$(document).ready(function() {
		$('#zapvis').submit(function(event) {
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
				$('#zapisnick').val('');
				$('#zapisball').val('');
				$('#history').val('');
			},
		});
		});
});
//------------Обновление даты--------------
$(document).ready(function() {
	$('#updatedates').submit(function(event) {
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultdate').html(data);
				$('#update').val('');
			},
		});
	});
});

//------------Очистить баллы-------------
$(document).ready(function() {
	$('#delpoints').submit(function(event) {
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultdiv11').html(data);
			},
		});
	});
});
