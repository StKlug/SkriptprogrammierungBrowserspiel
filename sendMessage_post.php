<?php
	require_once'lib/Database.class.php';
	require_once 'lib/Template.class.php';

	$message = htmlspecialchars($_POST["message"]);
	$receiver = htmlspecialchars($_POST["receiver"]);
	$sender = $_SESSION['email'];

    $dbh = Database::getInstance();

    $sth = $dbh->prepare('INSERT INTO message (message, receiverEmail, senderEmail) VALUES (:message, :receiver, :sender)');
    $sth->bindParam(':message', $message);
    $sth->bindParam(':receiver', $receiver);
    $sth->bindParam(':sender', $sender);

    $sth->execute();

    echo 'Message send!' . $sender;
?>

