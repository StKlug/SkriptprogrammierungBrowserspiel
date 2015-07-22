$('#form').submit(function () {
	if($('#pw').val() === "" || $('#user').value() === "")
	{
		$('#output').text("UserName oder Passwort leer gelassen!");
		return false;
	}
     
});


$('#regForm').submit(function(){
	if(!($('#passwordReg1').val() === $('#passwordReg2').val()))
	{
		$('#errorReg').text("Passwörter stimmen nicht überein!");
		$('#emailReg').css('background-color', '#FFFFFF');
		$('#usernameReg').css('background-color', '#FFFFFF');
		$('#passwordReg1').css('background-color', '#FF4040');
		$('#passwordReg2').css('background-color', '#FF4040');

		return false;
	}
	else if($('#passwordReg1').val() === "")
	{
		$('#errorReg').text("Bitte geben sie ein Passwort ein!");
		$('#emailReg').css('background-color', '#FFFFFF');
		$('#usernameReg').css('background-color', '#FFFFFF');
		$('#passwordReg1').css('background-color', '#FF4040');
		$('#passwordReg2').css('background-color', '#FF4040');

		return false;
	}
	else if($('#usernameReg').val() === "")
	{
		$('#errorReg').text("Bitte geben sie einen Usernamen ein!");
		$('#emailReg').css('background-color', '#FFFFFF');
		$('#usernameReg').css('background-color', '#FF4040');
		$('#passwordReg1').css('background-color', '#FFFFFF');
		$('#passwordReg2').css('background-color', '#FFFFFF');

		return false;
	}
	else if($('#emailReg').val() === "")
	{
		$('#errorReg').text("Bitte geben sie eine Email ein!");
		$('#emailReg').css('background-color', '#FF4040');
		$('#usernameReg').css('background-color', '#FFFFFF');
		$('#passwordReg1').css('background-color', '#FFFFFF');
		$('#passwordReg2').css('background-color', '#FFFFFF');
		return false;
	}
})