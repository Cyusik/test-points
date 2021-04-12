$(document).ready(function () {
	$('#trn_log').click(function () {
		var log = $('#act_log select').val();
		if (log === "") {
			alert('Укажите лог!');
		} else {
			$('.mainwindow').fadeIn();
			$('body').addClass('overflow');
			$('.mainwindow').addClass('disabled');
			$('#heading').html('Внимание');
			$('#spanwidow').html('Очистить таблицу из БД ?');
			$('#closewidow').click(function () {
				$('#heading').html('');
				$('#spanwidow').html('');
				$('.mainwindow').fadeOut();
				$('body').removeClass('overflow');
				$(this).attr('disabled', true);
				$('#hideME_log').fadeIn(800);

				function Out() {
					$('#hideME_log').fadeOut(800);
				}

				setTimeout(Out, 5000);
				$.ajax({
					type: "POST",
					url: "../../points/script/trnc_lg.php",
					data: $("#act_log").serialize(),
					success: function (result) {
						$('#div_result_log').html(result);
					},
				});
				return false;
			});
			$('#canceling').click(function () {
				$('body').removeClass('overflow');
				$('#heading').html('');
				$('#spanwidow').html('');
				$('.mainwindow').fadeOut();
			});
		}
	});
	$('#ex_log').click(function () {
		var log = $('#act_log select').val();
		if (log === "") {
			alert('Укажите лог!');
		}
	});
	$('#search_log select').change(function () {
		var param = $('#search_log select').val();
		if ((param === 'changes_log') || (param === 'srh_usr_log')) {
			$('#param_sl').remove();
			$('#search_log').append('<select id="param_sl" class="input in-select in-block" style="width:280px;" name="section">' +
				'<option value=""></option>' +
				'<option value="points">Таблица баллов</option>' +
				'<option value="results">Таблица итогов</option></select>');
		} else if (param === 'add_line_log') {
			$('#param_sl').remove();
			$('#search_log').append('<select id="param_sl" class="input in-select in_block" style="width:280px;" name="section">' +
				'<option value=""></option>' +
				'<option value="points">Таблица баллов</option>' +
				'<option value="results">Таблица итогов</option>' +
				'<option value="swap">Обмен</option></select>');
		} else {
			$('#param_sl').remove();
		}
	});
});