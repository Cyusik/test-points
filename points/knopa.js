function checkParams() {
	var nickname = $('#nickname').val();
	var login = $('#login').val();

	if(nickname.length != 0 && login.length != 0) {
		$('#submit').removeAttr('disabled');
	} else {
		$('#submit').attr('disabled', 'disabled');
	}
}