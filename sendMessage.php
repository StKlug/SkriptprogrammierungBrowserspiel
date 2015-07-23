<?php

require_once 'lib/Template.class.php';
$tpl = new Template();
if ($_SESSION['loggedIn']) {
    $tpl->assign('sender', $_SESSION['email']);
    $tpl->display('templates/sendMessage.tpl');
} else {
    //link zum Login
    header('location: login.php');
}
?>



