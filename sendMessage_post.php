<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once'lib/Database.class.php';
$message = htmlspecialchars($_POST["message"]);
$receiver = htmlspecialchars($_POST["receiver"]);
$sender = "test";

    $dbh = Database::getInstance();

    $sth = $dbh->prepare('INSERT INTO message (message, receiverEmail, senderEmail) VALUES (:message, :receiver, :sender)');
    $sth->bindParam(':message', $message);
    $sth->bindParam(':receiver', $receiver);
    $sth->bindParam(':sender', $sender);

    $sth->execute();

    echo 'Message send!'
?>

