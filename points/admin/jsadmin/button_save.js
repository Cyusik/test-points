$(document).ready(function () {
	$('#<?=$id_button_save?>').click(function () {
		$('#<?=$hideME?>').fadeIn(800);
		function Out() {
			$('#<?=$hideME?>').fadeOut(800);
		}
		setTimeout(Out, 5000);
		$.ajax({
			type: "POST",
			url: "../../points/script/save_results.php",
			data: $("#<?=$id_form?>").serialize(),
			success: function (result) {
				$("#<?=$div_result?>").html(result);
			},
		});
		return false;
	});
});