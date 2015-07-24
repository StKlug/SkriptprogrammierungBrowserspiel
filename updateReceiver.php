<?php
	require_once 'lib/Database.class.php';
	require_once 'lib/Template.class.php';

	if(!($_POST['email'] == NULL)){
		$db = Database::getInstance();
		$sth = $db->prepare("SELECT * From user");
		$sth->execute();

		$resultset = $sth->fetchAll();

		foreach ($resultset as $row) {
			if($_POST['email']) == $resultset['email']){
				$_SESSION['receiver'] = $_POST['email'];
			}
		}
		echo 'testinnen';
	}
?>