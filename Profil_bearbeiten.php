<?php
	require_once'lib/Database.class.php';
	require_once 'lib/Template.class.php';

	#$_SESSION['email']='testuser@mail.de';
	if ($_SESSION['logged_in'] == 'true'){
		$tpl = new Template();

		$dbh = Database::getInstance();

		$query = $dbh->prepare("SELECT nick,points,beschreibung From user WHERE email = :mail");
		$mail = htmlspecialchars($_SESSION['email']);
		$query->bindParam(':mail', $mail);
		$query->execute();
		$row = $query->fetch();
		$name = $row['nick'];
		$punkte = $row['points'];
		$beschr = $row['beschreibung'];

		 $query->closeCursor();

		 $tpl->assign('nick', $name);
		 $tpl->assign('points', $punkte);
		 $tpl->assign('beschr', $beschr);

		 $tpl->display('templates/profil_bearbeiten.tpl');
	} else {
    	header('location: login.php');
	}
?>