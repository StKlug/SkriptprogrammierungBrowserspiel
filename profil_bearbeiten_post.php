<?php 
	require_once'lib/Database.class.php';
	require_once 'lib/Template.class.php';

	$dbh = Database::getInstance();
	$sth = $dbh->prepare("UPDATE user SET beschreibung = :beschreibung WHERE email = :mail");
	$beschreibung = htmlspecialchars($_POST['beschreibung']);
	$mail = htmlspecialchars($_SESSION['email']);
	$sth->bindParam(':beschreibung', $beschreibung);
	$sth->bindParam(':mail', $mail);
	$sth->execute();

	header('Location: home.php');
?>