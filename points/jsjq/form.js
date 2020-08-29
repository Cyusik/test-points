$(document).ready(function() {
	$('#forms').submit(function(event) {
			event.preventDefault();
			var pointsnick = document.getElementById('resultdiv_search').value;
			var pointsnecessary = document.getElementById('resultdiv10').value;
			var nick = parseInt(pointsnick);
			var necessary = parseInt(pointsnecessary);
			if (isNaN(nick)) {
				$('.mainwindow').fadeIn();
				$('.mainwindow').addClass('disabled');
				$('#heading').html('Ошибка');
				$('#spanwidow').html('Такого никнейма нет в таблице');
				$('#closewidow').click(function() {
					$('.mainwindow').fadeOut();
					$('#heading').html('');
					$('#spanwidow').html('');
				});
			} else if (nick < necessary) {
				$('.mainwindow').fadeIn();
				$('.mainwindow').addClass('disabled');
				$('#heading').html('Ошибка');
				$('#spanwidow').html('Недостаточно баллов для обмена');
				$('#closewidow').click(function() {
					$('.mainwindow').fadeOut();
					$('#heading').html('');
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
						$('.mainwindow').fadeIn();
						$('.mainwindow').addClass('disabled');
						$('#heading').html('Обмен баллов');
						$('#spanwidow').html(data);
						$('#closewidow').click(function() {
							$('.mainwindow').fadeOut();
							$('#heading').html('');
							$('#spanwidow').html('');
						});
						$('#search').val('');
						$('#login').val('');
						var div3 =$('#list > div');
						div3.innerHTML = "";
						div3.remove();
						$('#resultdiv10').val('');
						$('#resultdiv_search').val('');
						x = 0;
					},
				});
			}
			var div3 =$('#list > div');
			div3.innerHTML = "";
			div3.remove();
		    $('#search').val('');
		    $('#login').val('');
			$('#resultdiv10').val('');
			$('#resultdiv_search').val('');
			x = 0;
	});
});
