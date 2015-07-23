<?php

require "Board.php";

class RandomAI extends AI
{
    function move($board, $player)
    {
        do {
            $column = rand(0, Board::COLUMN_COUNT - 1);
        } while (!$board->drop($player, $column));
    }
}