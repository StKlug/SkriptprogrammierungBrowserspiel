<?php

/**
 * Die Instanzen dieser Klasse repräsentieren einen kompletten Spielstand des Vier-Gewinnt-Spiels.
 * Das Board besteht hauptsächlich aus einem Feld mit 6 Zeilen und 7 Spalten.
 * Das Feld oben links hat die Inidzes (0, 0), unten rechts (6, 5).
 * Mit der Methode hasWon($player) kann überprüft werden, ob ein Spieler (mit einem Identifier ungleich 0) gewonnen hat.
 * Ein Zug wird mit drop($column) gemacht, wobei $column die Spalte angibt, in die der Spieler mit dem Identifier
 * $player (ungleich 0) seinen Spielstein wirft. Diese Methode gibt true zurück, wenn der Spielstein eingefügt wurde
 * und false, wenn die Spalte $column schon voll ist.
 */
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

    public function drop($player, $column)
    {
        if ($column < 0 || $column >= Board::COLUMN_COUNT) {
            return false;
        }
        for ($row = Board::ROW_COUNT - 1; $row >= 0; $row--) {
            if ($this->field[$column][$row] === 0) {
                $this->field[$column][$row] = $player;
                return true;
            }
        }
        return false;
    }

    public function get($column, $row)
    {
        return $this->field[$column][$row];
    }

    public function hasWon($player)
    {
        return $this->hasFourInARow($player) || $this->hasFourInAColumn($player) || $this->hasFourInADiagonal($player);
    }

    public function isFull()
    {
        for($i = 0; $i<Board::COLUMN_COUNT; $i++)
        {
            for($j = 0; $j<Board::ROW_COUNT; $j++)
            {
                if($this->field[$i][$j] === 0){
                    return false;
                }
            }
        }
        return true;
    }

    public function toJSON()
    {
        return json_encode($this->field);
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
$board->drop(1, 0);

echo json_encode($board->field);