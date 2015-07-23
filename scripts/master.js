
/*on load event */
$(function()
{
	$('#navbar li').click(
		function()
		{
			var target = $(this).data("target");
			if( target === undefined)
			{
				return false;
			}
			switch(target){
				case "home":
					window.location.href= "home.php";
				case "game":
					window.location.href= "game.php";
					break;
				case "profile":
					window.location.href="Profil_bearbeiten.php";
					break;
				case "login":
					window.location.href="login.php";
					break;
				case "logout":
					window.location.href ="logout.php";
					break;
				case "messages":
					window.location.href="readMessage.php";
					break;
				case "scores":
					window.location.href="readMessage.php";
					break;
				default:
			}
		}
	);
});
