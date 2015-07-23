<?php

session_start();

require_once("lib/Board.php");
require_once("lib/RandomAI.php");

$action = isset($_POST['action']) ? $_POST['action'] : '';

const HUMAN_PLAYER = 1;
const AI = 2;

$debugInfo = "";

if($action === 'newGame'){
    $_SESSION['expect_turn'] = 'false';
    $board = new Board();
    $_SESSION['board'] = serialize($board);
    $_SESSION['expect_turn'] = 'true';
}
else if($action === 'turn'){
    $board = unserialize($_SESSION['board']);
    if($_SESSION['expect_turn'] === 'true' && isset($_POST['column'])){
        $_SESSION['expect_turn'] = 'false';
        $columnRange = array ('options' => array ('min_range' => 0, 'max_range' => Board::COLUMN_COUNT - 1));
        $column = filter_input(INPUT_POST, 'column', FILTER_VALIDATE_INT, $columnRange); // $column ist nun null, false oder ein gueltiger Wert
        if(isset($column) && $column !== false){
            $debugInfo = $debugInfo . "empfangene column: " . $column . "; ";
            $successfulMove = $board->drop(HUMAN_PLAYER, $column);
            if($board->hasWon(HUMAN_PLAYER)){
                $debugInfo = $debugInfo . "Spieler hat gewonnen; ";
                // TODO Gewonnen-Nachricht
            }
            if($board->isFull() === true){
                // TODO Spiel-unentschieden-Nachricht
                $debugInfo = $debugInfo . "Board ist voll; ";
            }
            if($successfulMove === true){
                $debugInfo = $debugInfo . "erfolgreicher Zug des Spielers; ";
                $successfulMove = RandomAI::move($board, AI);
            }
            if($successfulMove === true){
                $debugInfo = $debugInfo . "erfolgreicher Zug der AI; ";
                if($board->hasWon(AI)){
                    // TODO Verloren-Nachricht
                    $debugInfo = $debugInfo . "AI hat gewonnen; ";
                }
                $_SESSION['board'] = serialize($board);
                $_SESSION['expect_turn'] = 'true';
            }
        } else {
            $debugInfo = $debugInfo . "illegale column empfangen: " . $column . "; ";
        }
    }
}

if(isset($_SESSION['board'])){

    $array = array();
    $array["board"] = unserialize($_SESSION['board'])->toJSON();
    $array["action"] = $debugInfo;
    echo json_encode($array);
}