<?php

session_start();

require_once "lib/Board.php";
require_once "lib/RandomAI.php";
require_once "lib/Database.class.php";

const HUMAN_PLAYER = 1;
const AI = 2;

$action = isset($_POST['action']) ? $_POST['action'] : '';

$message = ""; // possible values: "WON", "LOST", "TIE", "ILLEGAL_MOVE"

if ($action === 'newGame') {
    $_SESSION['expect_turn'] = 'false';
    $board = new Board();
    $_SESSION['board'] = serialize($board);
    $_SESSION['expect_turn'] = 'true';
} else if ($action === 'turn') {
    $board = unserialize($_SESSION['board']);
    if ($_SESSION['expect_turn'] === 'true' && isset($_POST['column'])) {
        $_SESSION['expect_turn'] = 'false';
        $columnRange = array('options' => array('min_range' => 0, 'max_range' => Board::COLUMN_COUNT - 1));
        $column = filter_input(INPUT_POST, 'column', FILTER_VALIDATE_INT, $columnRange); // $column ist nun null, false oder ein gueltiger Wert
        if (isset($column) && $column !== false) {
            $cancel = false;
            $successfulMove = $board->drop(HUMAN_PLAYER, $column);
            if ($successfulMove === false) {
                $message = "ILLEGAL_MOVE";
            }
            if ($board->hasWon(HUMAN_PLAYER)) {
                $cancel = true;
                $message = "WON";
                $_SESSION['expect_turn'] = 'false';
                // beim Sieg wird die Punktezahl in der Datenbank erhoeht
                if (isset($_SESSION['email'])) {
                    $db = Database::getInstance();
                    $sth = $db->prepare('UPDATE user SET points = points + 1 WHERE email = :email;');
                    $email = $_SESSION['email'];
                    $sth->bindParam(':email', $email);
                    $sth->execute();
                }
            }
            if ($cancel !== true) {
                if ($board->isFull() === true) {
                    $cancel = true;
                    $message = "TIE";
                    $_SESSION['expect_turn'] = 'false';
                }
                if ($cancel !== true) {
                    if ($successfulMove === true) {
                        $successfulMove = RandomAI::move($board, AI);
                    }
                    if ($successfulMove === true) {
                        if ($board->hasWon(AI)) {
                            $message = "LOST";
                            $_SESSION['expect_turn'] = 'false';
                        }
                    }
                    else if($board->isFull() === true){
                        $cancel = true;
                        $message = "TIE";
                        $_SESSION['expect_turn'] = 'false';
                    }
                }
            }
            $_SESSION['board'] = serialize($board);
            $_SESSION['expect_turn'] = 'true';
        } else {
            $message = "ILLEGAL_MOVE";
        }
    }
}

if (isset($_SESSION['board'])) {
    $array = array();
    $array["board"] = unserialize($_SESSION['board'])->toJSON();
    $array["message"] = $message;
    echo json_encode($array);
}