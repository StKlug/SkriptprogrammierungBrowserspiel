<?php
	require_once 'lib/Template.class.php';
	$tpl = new Template();
	$tpl->assign('articleHead', 'Login / Register');
	$tpl->display('templates/login.tpl');
?>