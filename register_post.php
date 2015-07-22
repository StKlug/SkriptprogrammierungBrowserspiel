<?php
	require_once 'lib/Template.class.php';
	require_once 'lib/Database.class.php';
	$tpl = new Template();

	$email = $_POST['emailReg'];
	$password = $_POST['passwordReg1'];
	$username = $_POST['usernameReg'];

	$password = password_hash($password, PASSWORD_DEFAULT);

	$db = Database::getInstance();

	$sth = $db->prepare('SELECT email FROM user WHERE email = :email');
	$sth->bindParam(':email', $email);

	$sth->execute();
	$row = $sth->fetch();
	
	if($row['email'] == $email)
	{
		$tpl->assign('message', 'Diese Emailadresse ist bereits registriert!<br>Bitte Loggen sie sich <a href="../login.php">hier</a> ein!');
	}
	else
	{
		$sth = $db->prepare('INSERT INTO user (email, nick, password, points, beschreibung) VALUES (:email, :nick, :password, 0, "")');
		$sth->bindParam(':email', $email); 
		$sth->bindParam(':nick', $username);
		$sth->bindParam(':password', $password);

		$sth->execute();

		$tpl->assign('message', 'Erfolgreich registriert!');
		$_SESSION['user'] = $username;
		$_SESSION['email'] = $email;
	}


	$tpl->display('templates/register_post.tpl');
?>