<?php

require_once 'lib/Template.class.php';
$tpl = new Template();
if ($_SESSION['logged_in'] == 'true') {
	if(isset($_POST['email']))
	{
		$tpl->assign('mail', $_POST['email']);
	}
	else
	{
		$tpl->assign('mail', '');
	}

    $tpl->assign('sender', $_SESSION['email']);
    $tpl->display('templates/sendMessage.tpl');
} else {
    //link zum Login
    header('location: login.php');
}
?>



