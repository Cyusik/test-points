//----------итоги обмена---------
//----------добавление строки-----
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
				$('#newdate').val('');
				$('#newnick').val('');
				$('#newitog').val('');
				$('#newprichina').val('');
			},
		});
	});
});
//-------------Очистить список--------------
$(document).ready(function() {
	$('#delresults').submit(function(event) {
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('#resultdiv10').html(data);
			},
		});
	});
});