$(document).ready(function () {
	$('#<?=$id_button_delet?>').click(function () {
		$('.mainwindow').fadeIn();
		$('.mainwindow').addClass('disabled');
		$('#heading').html('Внимание');
		$('#spanwidow').html('Удалить строку ' + $('#<?=$nick_results?>').val() + ' из БД ?');
		$('#closewidow').click(function () {
			$('.mainwindow').fadeOut();
			$('#heading').html('');
			$('#spanwidow').html('');
			$(this).attr('disabled', true);
			$('#<?=$hideME?>').fadeIn(800);
			$.ajax({
				type: "POST",
				url: "../../points/script/delet_results.php",
				data: $("#<?=$id_form?>").serialize(),
				success: function (result) {
					$().html(result);
				},
			});
			$("#<?=$id_tr?>").empty();
			$("#<?=$id_tr?>").stop().animate({
					height: "0px",
					opacity: 0,
				}, 800, function () {
					$(this).remove();
				}
			);
			return false;
		});
		$('#canceling').click(function () {
			$('.mainwindow').fadeOut();
			$('#heading').html('');
			$('#spanwidow').html('');
		});
	});
});