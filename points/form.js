/*$(document).ready(function() {
	$('#forms').submit(function(event) {

		$("select[name='priz5[]'] > option").each(function(){
			var content = $(this).text(),
				val = $(this).val();
			$(this).val(val + '|' + content);
			//var serializeFormData = $('#forms').serialize();
			event.preventDefault();
		//alert('pidor');

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
});*/
$(document).ready(function() {
$('#submit').click(function() {
	//var serializeFormData = $('#forms').serialize();
	$("#list")("select[name='priz5[]'] > option").each(function() {
		var content = $(this).text(),
			val = $(this).val();
		$(this).val(val + '|' + content);
		alert(val);
	});
		$.ajax({
			type: 'POST',
			url: '/points/script/swapform.php',
			data: serializeFormData,
			success: function (data) {
				//console.log(data);
				$('#resultdiv').html(data);
			},
			error: function (data) {
				console.log('Внимание! произошла ошибка:' + data);
			}
		});

  });
});

/*$(document).ready(function() {
	$('#submit').on('click',function() {
		//alert('pidor');
		//e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '/points/script/swapform.php',
			data: {
				'nicknames5': name,
				'login5': name,
				'priz5': name,
			},
			//contentType: false,
			//cache: false,
			//processData: false,
			success: function(respone) {
				$('#resultdiv').html(respone).show();
				$('#search').val('');
				$('#login').val('');
			},
		});
	});
});*/