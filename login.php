<?php
	require_once 'lib/Template.class.php';
	$tpl = new Template();
	$tpl->assign('articleHead', 'Login / Register');


	//$tpl->assign('content', 'Login');


	$tpl->display('templates/login.tpl');
?>