<?php
 require_once 'lib/Template.class.php';
 $tpl = new Template();
 $tpl->assign('articleHead', 'Willkommen');
 $tpl->assign('content', 'Das ist die erste Seite.');
 
 
 
 $tpl->display('templates/article.tpl');
?>
