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
//-----------------------------------------
$(document).ready(function() {
	$('#countfile').on('change', function() {
		var splittedFakePath = this.value.split('\\');
		$('#countfileON').text(splittedFakePath[splittedFakePath.length - 1]);
	});
	$('#count_points').submit(function(event) {
		event.preventDefault();
		//var uploadfile = $('#uploadfile');
		$('#loadgif').css('display','initial');
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function (data) {
				$('#loadgif').css('display','none');
				$('#resultcount').html(data);
				$('#countfile').val('');
				$('#countfileON').text('Выберите файл');
			},
		});
	});
});
