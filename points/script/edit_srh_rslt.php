<?php
$row = mysqli_fetch_row($result_sql);
$id_button_save = 'save1'.$i;
$id_button_delet = 'delet1'.$i;
$id_form = 'form1'.$i;
$div_result = 'result_div1'.$i;
$hideME = 'hide_Me1'.$i;
$nick_results = 'nick_resultsid'.$i;
$id_tr = 'tr1'.$i;
echo	"<div id='$id_tr'>
						<form id='$id_form' action='' method='POST'>
						<div id='$hideME' class='modal_div_interior' style='display:none'>
						<div id='$div_result' class='modal_div_external'></div></div>";
echo nl2br("<input style='display:none' class='input' name='id_results' value='$row[0]' readonly='readonly'>");
echo nl2br("<input class='input editing' name='dates_results' value='$row[1]' readonly='readonly'>");
echo nl2br("<input id='$nick_results' class='input editing' name='nick_results' value='$row[2]' placeholder='Никнейм'>");
echo nl2br("<input class='input editing' name='result_results' value='$row[3]' placeholder='Итог'>");
echo nl2br("<input class='input editing' name='cause_results' value='$row[4]' placeholder='Причина'>");
echo "<button id='$id_button_save' type='submit' class='button editing' style='vertical-align:middle'>Сохранить</button>";
echo "<script>
							$(document).ready(function () {
								$('#$id_button_save').click(function () {
									$('#$hideME').fadeIn(800);
									function Out() {
										$('#$hideME').fadeOut(800);
									}
									setTimeout(Out, 5000);
									$.ajax({
										type: \"POST\",
										url: \"../../points/script/save_results.php\",
										data: $(\"#$id_form\").serialize(),
										success: function (result) {
											$(\"#$div_result\").html(result);
										},
									});
									return false;
								});
							});
						</script>";
echo "<span id='$id_button_delet' class='button btn-span' style='vertical-align:middle;'>Удалить</span>";
echo "<script>
							$(document).ready(function () {
								$('#$id_button_delet').click(function () {
									$('.mainwindow').fadeIn();
									$('body').addClass('overflow');
									$('.mainwindow').addClass('disabled');
									$('#heading').html('Внимание');
									$('#spanwidow').html('Удалить строку ' + $('#$nick_results').val() + ' из БД ?');
									$('#closewidow').click(function () {
										$('body').removeClass('overflow');
										$('#heading').html('');
										$('#spanwidow').html('');
										$('.mainwindow').fadeOut();
										$(this).attr('disabled', true);
										$('#$hideME').fadeIn(800);
										$.ajax({
											type: \"POST\",
											url: \"../../points/script/delet_results.php\",
											data: $(\"#$id_form\").serialize(),
											success: function (result) {
												$().html(result);
											},
										});
										$(\"#$id_tr\").empty();
										$(\"#$id_tr\").stop().animate({
												height: \"0px\",
												opacity: 0,
											}, 800, function () {
												$(this).remove();
											}
										);
										return false;
									});
									$('#canceling').click(function () {
										$('body').removeClass('overflow');
										$('#heading').html('');
										$('#spanwidow').html('');
										$('.mainwindow').fadeOut();
									});
								});
							});
						</script>";
echo "</form></div>";
?>