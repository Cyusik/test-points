$(document).ready(function(){
	$("#addclick").click(function(){
		$("#hideMe").fadeIn(800);
		function Out() {
			$("#hideMe").fadeOut(800);
		}
		setTimeout(Out, 5000);
	});
});