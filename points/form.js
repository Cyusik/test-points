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
				$('#search').val('');
				$('#login').val('');
				},
		});
	});
});

/*-------------------*/
$(document).ready(function() {
	$('#list').change(function() {
		var values = '';
		$.each($("#list select"), function () {
			values += this.value;
			var names = values;
			$('#resultdiv10').html('Вывод: ' + names);
			//$.ajax({
			//	type:'POST',
			//	url:'select_calc.php',
			//	data: {
			//		testt: names
			//	},
				//contentType: false,
				//cache: false,
				//processData: false,
			//	success: function (respone) {
			//		$('#resultdiv10').html(respone).show();
					//$('#search').val('');
					//$('#login').val('');
			//	},
			//});
		});
	});
});