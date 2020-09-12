$(document).ready(function() {
	$('#form_add_user').submit(function(event) {
		event.preventDefault();

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#result_add').html(data);
				$('#add_login').val('');
				$('#add_password').val('');
			},
		});
	});
});
//----------------------------------------------
$(document).ready(function() {
	$('#logadmin').submit(function(event) {
		event.preventDefault();

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultlogadmin').html(data);
				$('#monthlogadmin').val('');
			},
		});
	});
});
//--------------------------------------------------
$(document).ready(function() {
	$('#logswap').submit(function(event) {
		event.preventDefault();

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultlogswap').html(data);
				$('#monthlogswap').val('');
			},
		});
	});
});
//-----------------------------------------------------
$(document).ready(function() {
	$('#logsearch').submit(function(event) {
		event.preventDefault();

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultlogsearch').html(data);
				$('#monthlogsearch').val('');
			},
		});
	});
});
//----------------------------------------------------
$(document).ready(function() {
	$('#logresults').submit(function(event) {
		event.preventDefault();

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultlogresults').html(data);
				$('#monthlogresults').val('');
			},
		});
	});
});
//----------------------------------------------------
$(document).ready(function() {
	$('#logpoints').submit(function(event) {
		event.preventDefault();

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultlogpoints').html(data);
				$('#monthlogpoints').val('');
			},
		});
	});
});
//----------------------------------------------------
$(document).ready(function() {
	$('#logexchange').submit(function(event) {
		event.preventDefault();

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultlogexchange').html(data);
				$('#monthlogexchange').val('');
			},
		});
	});
});
//---------------------------------------------------------
$(document).ready(function() {
	$('#admin_clear_log').submit(function(event) {
		event.preventDefault();

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultclear').html(data);
			},
		});
	});
});
//----------------------------------------------------------
$(document).ready(function() {
	$('#search_clear_log').submit(function(event) {
		event.preventDefault();

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultclear').html(data);
			},
		});
	});
});
//----------------------------------------------------------
$(document).ready(function() {
	$('#swap_clear_log').submit(function(event) {
		event.preventDefault();

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultclear').html(data);
			},
		});
	});
});
//----------------------------------------------------------
$(document).ready(function() {
	$('#points_clear_log').submit(function(event) {
		event.preventDefault();

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultclear').html(data);
			},
		});
	});
});
//----------------------------------------------------------
$(document).ready(function() {
	$('#results_clear_log').submit(function(event) {
		event.preventDefault();

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultclear').html(data);
			},
		});
	});
});
//----------------------------------------------------------
$(document).ready(function() {
	$('#exchange_clear_log').submit(function(event) {
		event.preventDefault();

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultclear').html(data);
			},
		});
	});
});