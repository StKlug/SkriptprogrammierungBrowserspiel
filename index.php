<?php
 require_once 'lib/Template.class.php';
 $tpl = new Template();
 $tpl->assign('articleHead', 'Willkommen bei Vier Gewinnt');
 $tpl->assign('content', 'Dies ist die Startseite des Vier gewinnt Spiels, falls Sie noch nicht registriert sind benutzen sie bitte die Schaltfläche auf der linken Seite, um einen Account zu erstellen.');
 $tpl->display('templates/article.tpl');
?>
