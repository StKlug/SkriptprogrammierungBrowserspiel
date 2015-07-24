<?php
	require_once 'lib/Database.class.php';
	require_once 'lib/Template.class.php';

	if(!($_POST['mail'] == NULL)){
		$db = Database::getInstance();
		$sth = $db->prepare("SELECT * From user");
		$sth->execute();

		$resultset = $sth->fetchAll();

		foreach ($resultset as $row) {
			if($_POST['mail']) == $resultset['email']){
				$_SESSION['receiver'] = $_POST['mail'];
			}
		}
		echo 'testinnen';
	}
?>