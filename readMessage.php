<?php
	require_once'lib/Database.class.php';
	require_once 'lib/Template.class.php';

	#$_SESSION['loggedIn']=true;
	#$_SESSION['email']='testuser@mail.de';

	$tpl = new Template();

	if ($_SESSION['logged_in'] == 'true'){
		$db = Database::getInstance();

		$sth = $db->prepare("SELECT * From message WHERE receiverEmail = :email");
		$sth->bindParam('email', $_SESSION['email']);
		$sth->execute();

		$resultset = $sth->fetchAll();

		$table = '<table border rules=all><tr><th>Von:</th><th>Nachricht</th><th>Sededatum</th><th>Antworten</th></tr>';
		foreach ($resultset as $row) {
			$currentEmail = $row['senderEmail'];
			$table = $table.'<tr><td width="20%">' . $row['senderEmail'] . '</td><td>' . $row['message'] . '</td><td width="20%">' . $row['send'] . '</td><td><div align="center"><a href="sendMessage.php?page='. $currentEmail .'"><img src="images/answer.png"></a></div></td></tr>';
		}

		$table = $table . '</table>';

		$tpl->assign('message', $table);
		$tpl->display('templates/readMessage.tpl');
	} 
	else{
	    header('location: login.php');
	}
?>