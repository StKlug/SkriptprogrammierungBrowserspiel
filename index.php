<?php
 require_once 'lib/Template.class.php';
 require_once 'lib/Database.class.php';
 
 $tpl = new Template();
 $db = Database::getInstance();
 $query = $db->query("SELECT COUNT(1) as 'count' FROM user");
 $row = $query->fetch();
 $count = $row['count'];
 $query->closeCursor();
 $tpl->assign('articleHead', 'Willkommen bei Vier Gewinnt');
 $tpl->assign('content', 'Dies ist die Startseite des Vier gewinnt Spiels,
  falls Sie noch nicht registriert sind benutzen sie bitte die Schaltfläche auf der linken Seite,
   um einen Account zu erstellen.<br />
   Es gbt zur Zeit '. $count. " Spieler.");
 $tpl->display('templates/article.tpl');
?>
