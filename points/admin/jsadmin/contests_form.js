$(document).ready(function() {
	$('#contests_form').submit(function(event) {
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				var result = $('#result_contests');
				result.html(data);
				result.fadeIn();
				$('input').val('');
			},
		});
	});
});
//---------------------------------------------------
$(document).ready(function() {
	$('#countfile').on('change', function() {
		var splittedFakePath = this.value.split('\\');
		$('#countfileON').text(splittedFakePath[splittedFakePath.length - 1]);
	});
	$('#count_points').submit(function(event) {
		event.preventDefault();
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
//-----------------------------------------------
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
				$('#resultdiv11').html(data).fadeIn();
			},
		});
	});
});
//---------------------------
$(document).ready(function() {
	$('#imp_file').on('change', function() {
		var splittedFakePath = this.value.split('\\');
		$('#imp_fileON').text(splittedFakePath[splittedFakePath.length - 1]);
	});
	$('#imp_points').submit(function(event) {
		event.preventDefault();
		$('#loadgif_ipm').css('display','initial');
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function (data) {
				$('#loadgif_ipm').css('display','none');
				$('#result_imp').html(data);
				$('#imp_file').val('');
				$('#imp_fileON').text('Выберите файл');
			},
		});
	});
});
//----------------------------------------------
$(document).ready(function() {
	$('#update_date').submit(function(event) {
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
				$('#update_date_in').val('');
			},
		});
	});
});
//----------------------------------------
$(document).ready(function() {
	$('#del_user').submit(function(event) {
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#res_del').html(data).fadeIn();
			},
		});
	});
});