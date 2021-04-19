<?php
if(isset($_POST['period_time'])) {
	include_once '../script/connect.php';
	$period_time = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['period_time'])));
	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
	if(validateDate($period_time, 'Y-m') == false) {
		echo "Некорректная дата";
		$link->close();
		exit();
	}
	$srh_ig = "SELECT * FROM ignoresstory WHERE `date` LIKE'$period_time%' ORDER BY `date` DESC LIMIT 150";
	$res_srh = mysqli_query($link, $srh_ig) or die('Error :'.mysqli_error($link));
	if($res_srh) {
		$rows = mysqli_num_rows($res_srh);
		if($rows > 0) {
			for($i = 0; $i < $rows; ++$i) {
	//--------------------------------------------------------------------
				$row = mysqli_fetch_row($res_srh);
				$id_ignore_tr = 'ignore_tr'.$i;
				$id_button_accrued = 'save_accrued'.$i;
				$id_button_deletIg = 'delet_Ig'.$i;
				$div_result_ignore = 'result_div1_Ig'.$i;
				$hideME = 'hide_Me1'.$i;
				$id_form_ignore = 'formIg'.$i;
				$nick_ignore = 'nick_ignore'.$i;
				echo "<div id='$id_ignore_tr'>
					<form id='$id_form_ignore' name='form' method='POST' action=''>
					<div id='$hideME' class='modal_div_interior' style='display:none'>
					<div id='$div_result_ignore' class='modal_div_external' ></div></div>
					<input style='display:none' id='' class='input disable' type='text' name='id_ignore' value='$row[0]' readonly>
					<input id='' class='input disable' type='text' name='date_ignore' value='$row[1]' readonly>
					<input id='$nick_ignore' class='input disable' type='text' name='nick_ignore' value='$row[2]' readonly>
					<input id='' class='input disable' type='text' name='points_ignore' value='$row[3]' readonly>
					<button id='$id_button_accrued' type='submit' class='button' style='vertical-align:middle'>Начислить</button>";
				echo "<script>
								$(document).ready(function() {
									if ($row[4] === 1) {
										$('#$id_button_accrued').html('Начислено');
										$('#$id_button_accrued').addClass('butnone');
										$('#$id_button_accrued').prop(\"disabled\", true);
									} else
									{
										$('#$id_button_accrued').click(function () {
											$('#$hideME').fadeIn(800);
											function Out() {
												$('#$hideME').fadeOut(800);
											}
											setTimeout(Out, 5000);
											$.ajax({
												type: \"POST\",
												url: \"../../points/script/accrued_ignore.php\",
												data: $(\"#$id_form_ignore\").serialize(),
												success: function (result) {
													$(\"#$div_result_ignore\").html(result);
													$('#$id_button_accrued').html('Начислено');
													$('#$id_button_accrued').addClass('butnone');
													$('#$id_button_accrued').prop(\"disabled\", true);
												},
											});
											return false;
										});
									}
									});
							</script></form></div>";
	//----------------------------------------------------------------------
			}
		} else {
			echo '<table class="table_history">
					<tr><th>Ошибка</th></tr>
					<tr><td>Нет записей за этот период</td></tr>
					</table>';
		}
	} else {
		echo '<table class="table_history">
					<tr><th>Ошибка</th></tr>
					<tr><td>empty result</td></tr>
					</table>';
	}
	$link->close();
}
?>