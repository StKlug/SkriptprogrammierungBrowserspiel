<?php
	require_once 'lib/Template.class.php';
	require_once 'lib/Database.class.php';
	$tpl = new Template();

	$_SESSION['user'] = null;
	$_SESSION['email'] = null;
	$_SESSION['logged_in'] = false;

	$tpl->assign('message', 'Sie wurden abgemeldet!'); 
	$tpl->display('templates/register_post.tpl');
?>