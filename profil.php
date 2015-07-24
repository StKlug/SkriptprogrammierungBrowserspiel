<?php

	require_once'lib/Database.class.php';
	require_once 'lib/Template.class.php';

	if ($_SESSION['logged_in'] == 'true'){

		$tpl = new Template();

		$dbh = Database::getInstance();

		$query = $dbh->prepare("SELECT nick,points,beschreibung From user WHERE email = :mail");
		$mail = htmlspecialchars($_GET['email']);
		$_SESSION['sendEmail'] =$_GET['email'];
		$query->bindParam(':mail', $mail);
		$query->execute();
		$row = $query->fetch();
		$name = $row['nick'];
		$punkte = $row['points'];
		$beschr = $row['beschreibung'];

		 $tpl->assign('nick', $name);
		 $tpl->assign('points', $punkte);
		 $tpl->assign('beschr', $beschr);

		 $tpl->display('templates/profil.tpl');
	

	} else {
    	header('location: login.php');
	}
?>