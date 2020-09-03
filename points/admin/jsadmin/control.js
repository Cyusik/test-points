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