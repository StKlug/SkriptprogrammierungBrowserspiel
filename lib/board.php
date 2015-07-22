<?php

class Board
{
    public $field;

    const COLUMN_COUNT = 7;
    const ROW_COUNT = 6;

    public function __construct()
    {
        $this->field = array(array());
        for ($i = 0; $i < Board::COLUMN_COUNT; $i++) {
            for ($j = 0; $j < Board::ROW_COUNT; $j++) {
                $this->field[$i][$j] = 0;
            }
        }
    }

    public function get($column, $row)
    {
        return $this->field[$column][$row];
    }

    public function hasWon($player)
    {
        return $this->hasFourInARow($player) || $this->hasFourInAColumn($player) || $this->hasFourInADiagonal($player);
    }

    private function hasFourInARow($player)
    {
        for ($row = 0; $row < Board::ROW_COUNT; $row++) {
            $counter = 0;
            for ($column = 0; $column < Board::COLUMN_COUNT; $column++) {
                if ($this->field[$column][$row] === $player) {
                    $counter++;
                    if ($counter === 4) {
                        return true;
                    }
                } else {
                    $counter = 0;
                }
            }
        }
        return false;
    }

    private function  hasFourInAColumn($player)
    {
        for ($column = 0; $column < Board::COLUMN_COUNT; $column++) {
            $counter = 0;
            for ($row = 0; $row < Board::ROW_COUNT; $row++) {
                if ($this->field[$column][$row] === $player) {
                    $counter++;
                    if ($counter === 4) {
                        return true;
                    }
                } else {
                    $counter = 0;
                }
            }
        }
        return false;
    }

    private function hasFourInADiagonal($player)
    {
        return $this->hasFourInLRDiagonal($player) || $this->hasFourInRLDiagonal($player);
    }

    private function hasFourInLRDiagonal($player)
    {
        for ($startColumn = 0; $startColumn < Board::COLUMN_COUNT - 3; $startColumn++) {
            $counter = 0;
            for ($row = 0; $row < Board::ROW_COUNT && $startColumn + $row < Board::COLUMN_COUNT; $row++) {
                if ($this->field[$startColumn + $row][$row] === $player) {
                    $counter++;
                    if ($counter === 4) {
                        return true;
                    }
                } else {
                    $counter = 0;
                }
            }
        }
        for ($startRow = 1; $startRow < Board::ROW_COUNT; $startRow++) {
            $counter = 0;
            for ($column = 0; $column < Board::COLUMN_COUNT && $startRow + $column < Board::ROW_COUNT; $column++) {
                if ($this->field[$column][$startRow + $column] === $player) {
                    $counter++;
                    if ($counter === 4) {
                        return true;
                    }
                } else {
                    $counter = 0;
                }
            }
        }
        return false;
    }

    private function hasFourInRLDiagonal($player)
    {
        for ($startColumn = 3; $startColumn < Board::COLUMN_COUNT; $startColumn++) {
            $counter = 0;
            for ($row = 0; $row < Board::ROW_COUNT && ($startColumn - $row) >= 0; $row++) {
                if ($this->field[$startColumn - $row][$row] === $player) {
                    $counter++;
                    if ($counter === 4) {
                        return true;
                    }
                } else {
                    $counter = 0;
                }
            }
        }
        for ($startRow = 1; $startRow < Board::ROW_COUNT; $startRow++) {
            $counter = 0;
            for ($column = Board::COLUMN_COUNT - 1; $column >= 0 && ($startRow + Board::COLUMN_COUNT - 1 - $column) < Board::ROW_COUNT; $column--) {
                if ($this->field[$column][$startRow + Board::COLUMN_COUNT - 1 - $column] === $player) {
                    $counter++;
                    if ($counter === 4) {
                        return true;
                    }
                } else {
                    $counter = 0;
                }
            }
        }
        return false;
    }
}

$board = new Board();
print_r($board->field);
echo '<br>';
echo $board->hasWon(1);