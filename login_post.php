<?php
	require_once 'lib/Template.class.php';
	require_once 'lib/Database.class.php';
	$tpl = new Template();

	$email = $_POST['email'];
	$password = $_POST['password'];

	$db = Database::getInstance();

	$sth = $db->prepare('SELECT * FROM user WHERE email = :email');
	$sth->bindParam(':email', $email);

	$sth->execute();
	$row = $sth->fetch();

	$password_hash = $row['password'];
	
	if($row['email'] == $email) //email is in database
	{
		if(password_verify($password, $password_hash)) //password vallid
		{
			$_SESSION['user'] = $row['nick'];
			$_SESSION['email'] = $email;
			$_SESSION['logged_in'] = true;

			$tpl->assign('message', 'Erflogreich angemeldet als: ' . $_SESSION['user']); 
		}
		else
		{
			$tpl->assign('message', 'Email oder Passwort sind falsch!<br>Versuchen sie es <a href="login.php">hier</a> erneut!');
		}
	}
	else //email is not in database
	{
		$tpl->assign('message', 'Email oder Passwort sind falsch!<br>Versuchen sie es <a href="login.php">hier</a> erneut!');
	}

	$tpl->display('templates/register_post.tpl');
?>