<?php

require_once'lib/Database.class.php';
require_once 'lib/Template.class.php';

#$_SESSION['loggedIn']=true;
#$_SESSION['email']='testuser@mail.de';

$tpl = new Template();

if ($_SESSION['loggedIn']){
$dbh = Database::getInstance();

$query = $dbh->prepare("SELECT senderEmail, message From message WHERE receiverEmail = :email");
$query->bindParam(':email', $_POST["email"]);
$query->execute();
$row = $query->fetchAll(PDO::FETCH_ASSOC);
for ($i = 0; $i < count($row); $i++) {
    $senderEmail[$i] = $row[$i]['senderEmail'];
    $message[$i] = $row[$i]['message'];
}
$query->closeCursor();

$tpl->assign('senderEmail', $senderEmail);
$tpl->assign('message', $message);

$tpl->display('templates/sendMessage.tpl');
} else{
    header('location: login.php');
}
?>