$(document).ready(function() {
	$('#forms').submit(function(event) {
			event.preventDefault();
			var pointsnick = $('#resultdiv_search');
			var pointsnecessary = $('#resultdiv10');
			var xone = pointsnick.val();
			var xtwo = pointsnecessary.val();
			if (xone === 'Никнейм не найден') {
				$('.mainwindow').fadeIn();
				$('.mainwindow').addClass('disabled');
				$('#spanwidow').html('Такого никнейма нет в таблице');
				$('#closewidow').click(function() {
					$('.mainwindow').fadeOut();
					$('#spanwidow').html('');
				});
			} else if (xtwo > xone){
				$('.mainwindow').fadeIn();
				$('.mainwindow').addClass('disabled');
				$('#spanwidow').html('У вас недостаточно баллов');
				$('#closewidow').click(function() {
					$('.mainwindow').fadeOut();
					$('#spanwidow').html('');
				});
			}
			else {
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
						var div3 =$('#list > div');
						div3.innerHTML = "";
						div3.remove();
						pointsnecessary.val('');
						pointsnick.val('');
						x = 0;
					},
				});
			}
			var div3 =$('#list > div');
			div3.innerHTML = "";
			div3.remove();
		    $('#search').val('');
		    $('#login').val('');
		    pointsnecessary.val('');
			pointsnick.val('');
			x = 0;
	});
});
