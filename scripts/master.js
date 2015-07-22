
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
				case "game":
					window.location.href= "game.php";
				case "profile":
					window.location.href="profile.php";
				case "register":
					window.location.href="register.php";
				default:
			}
		}
	);
});
