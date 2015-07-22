<?php 
	require_once'lib/Database.class.php';
	require_once 'lib/Template.class.php';

	$dbh = Database::getInstance();
	$sth = $dbh->prepare("UPDATE user SET beschreibung = :beschreibung WHERE email = '" . $_SESSION['email'] . "'");
	$sth->bindParam(':beschreibung', $_POST['beschreibung']);
	$sth->execute();

	header('Location: home.php');
?>