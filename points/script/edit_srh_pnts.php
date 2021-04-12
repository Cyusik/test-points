<?php
$row = mysqli_fetch_row($result_sql);
$id_button_save = 'save_click1'.$i;
$id_button_delet = 'delet_click1'.$i;
$div_result = 'result_div1'.$i;
$hideME = 'hide_Me1'.$i;
$id_form = 'form'.$i;
$id_tr = 'tr1'.$i;
echo	"<div id='$id_tr'>
						<form id='$id_form' action='' method='POST'>
						<div id='$hideME' class='modal_div_interior' style='display:none'>
						<div id='$div_result' class='modal_div_external'></div></div>";
echo nl2br("<input style='display:none' id='id_test' class='input' name='id_user' value='$row[0]' readonly='readonly'>");
echo nl2br("<input id='nick_test' class='input editing' name='nick_user' value='$row[1]' required placeholder='Никнейм'>");
echo nl2br("<input id='point_test' class='input editing' name='point_user' value='$row[2]' placeholder='Баллы'>");
echo "<textarea style='width: 50%;' id='history_test' class='input textarea editing' name='history_user' placeholder='История обмена'>$row[3]</textarea>";
echo nl2br("<input style='display:none' id='ignor_test' class='input editing' name='ignor_user' value='$row[4]' readonly='readonly'>");
echo nl2br("<input style='width: 50%;' class='input editing' id='login_one' name='login_one' value='$row[5]' placeholder='Логин 1'>");
echo nl2br("<input style='width: 50%;' class='input editing' id='login_two' name='login_two' value='$row[6]' placeholder='Логин 2'>");
echo nl2br("<input style='width: 50%;' class='input editing' id='login_three' name='login_three' value='$row[7]' placeholder='Логин 3'>");
echo "<br><button id='$id_button_save' type='submit' class='button editing' style='vertical-align:middle'>Сохранить</button>";
echo "<script>
							$(document).ready(function() {
									$('#$id_button_save').click(function() {
										$('#$hideME').fadeIn(800);
										function Out() {
											$('#$hideME').fadeOut(800);
										}
										setTimeout(Out, 5000);
										$.ajax({
											type: \"POST\",
											url: \"../../points/script/save_changes.php\",
											data: $(\"#$id_form\").serialize(),
											success: function (result) {
												$(\"#$div_result\").html(result);
											},
										});
										return false;
									});
								});
						</script>";
echo "<span id='$id_button_delet' class='button' style='vertical-align:middle; width:7%;'>Удалить</span>";
echo "<script>
							$(document).ready(function() {
									$('#$id_button_delet').click(function () {
										var nick = $('#nick_test').val();
										$('.mainwindow').fadeIn();
										$('body').addClass('overflow');
										$('.mainwindow').addClass('disabled');
										$('#heading').html('Внимание');
										$('#spanwidow').html('Удалить строку ' + nick + ' из БД ?');
										$('#closewidow').click(function() {
											$('#heading').html('');
											$('#spanwidow').html('');
											$('.mainwindow').fadeOut();
											$('body').removeClass('overflow');
											$(this).attr('disabled', true);
											$('#$hideME').fadeIn(800);
											$.ajax({
												type: \"POST\",
												url: \"../../points/script/delet_user.php\",
												data: $(\"#$id_form\").serialize(),
												success: function (result) {
													$().html(result);
												},
											});
											$(\".$id_tr\").empty();
											$(\".$id_tr\").stop().animate({
													height: \"0px\",
													opacity: 0,
												}, 800, function() {
													$(this).remove();
												}
											);
											return false;
										});
										$('#canceling').click(function() {
											$('body').removeClass('overflow');
											$('#heading').html('');
											$('#spanwidow').html('');
											$('.mainwindow').fadeOut();
										});
									});
								});
						</script>";
echo "<script type='text/javascript' src='../admin/jsadmin/textarea_points.js'></script></form></div>";
?>