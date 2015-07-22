<?php

class RandomAI extends AI
{
    function move($board){
        return rand(0, Board::COLUMN_COUNT-1);
    }
}