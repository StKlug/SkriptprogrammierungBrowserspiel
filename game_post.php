<?php

include("lib/Board.php");

$action = isset($_POST['action']) ? $_POST['action'] : '';
//echo print_r($_POST);

if($action === 'newGame'){
    $_SESSION['expect_turn'] = 'false';
    $board = new Game();
    $_SESSION['board'] = serialize($board);
    $_SESSION['expect_turn'] = 'true';
    file_put_contents('store', $s);
}
else if($action === 'turn'){
    $board = unserialize($_SESSION['board']);
    if($_SESSION['expect_turn'] === 'true' && isset($_POST['column'])){
        $columnRange = array ('options' => array ('min_range' => 0, 'max_range' => Board::COLUMN_COUNT - 1));
        $column = filter_input(INPUT_POST, 'column', FILTER_VALIDATE_INT, $range); // $column ist nun null, false oder ein gueltiger Wert
        echo $column;
    }
}

if(isset($_SESSION['board'])){
    echo print_r($_SESSION['board']);
}