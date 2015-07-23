<?php

	require_once'lib/Database.class.php';
	require_once 'lib/Template.class.php';
	if(isset(($_GET['send'])))
	{
		header('Location: sendMessage.php ');

	}else
	{
		 $tpl = new Template();

		$dbh = Database::getInstance();

		$query = $dbh->prepare("SELECT nick,points,beschreibung From user WHERE email = :mail");
		$mail = htmlspecialchars($_POST['email']);
		$_SESSION['sendEmail'] =$_POST['email'];
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
	}
?>