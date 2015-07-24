<?php
	require_once 'lib/Template.class.php';
	require_once'lib/Database.class.php';

	$tpl = new Template();
	if ($_SESSION['logged_in'] == 'true') {

		if(!isset($_SESSION['receiver']))
		{
			$_SESSION['receiver'] = $_SESSION['email']; 
		}

		$db = Database::getInstance();
		$sth = $db->prepare("SELECT email From user");
		$sth->bindParam('email', $_SESSION['email']);
		$sth->execute();

		$resultset = $sth->fetchAll();

		$options = '';
		foreach ($resultset as $row) {
			$currentEmail = $row['email'];
			if($currentEmail == $_SESSION['receiver']){
				$options = $options .  '<option selected>' . $currentEmail . '</option>';
			}
			else{
				$options = $options .  '<option>' . $currentEmail . '</option>';
			}
		}

		$tpl->assign('options', $options);
		$tpl->assign('mail', $_SESSION['email']);


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



