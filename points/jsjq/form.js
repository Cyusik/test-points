$(document).ready(function() {
	$('#forms').submit(function(event) {
			event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultdiv').html(data);
				//$('#search').val('');
				//$('#login').val('');
				},
		//});
		});
	});
});
