<?php

require_once("Board.php");

class RandomAI
{
    public static function move($board, $player)
    {
        do {
            $column = rand(0, Board::COLUMN_COUNT - 1);
        } while (!$board->drop($player, $column));
        return true;
    }
}