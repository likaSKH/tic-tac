<?php
/**
 * Created by PhpStorm.
 * User: ami
 * Date: 10/29/15
 * Time: 10:02 AM
 */

namespace AppBundle\Tic;

class Board
{
    private $grid = array();
    private $boardColor = array();
    private $dimension;

    const NOTHING = '';
    const O = 'o';
    const X = 'x';

    /**
     * Board constructor.
     */
    public function __construct()
    {
        $game = new Game();
        $this->dimension = $game->getDimension();

        $this->initGrid();
        $this->clear();
    }

    private function initGrid()
    {
        for($i = 0; $i < $this->dimension; $i++) {
            $this->grid[] = array();
        }
    }

    public function clear()
    {
        for($i = 0; $i < $this->dimension; $i++) {
            for($j = 0; $j < $this->dimension; $j++) {
                $this->setSquare($i, $j, self::NOTHING);
            }
        }
    }

    public function getSquare($row, $col)
    {
        return $this->grid[$row][$col];
    }

    public function setSquare($row, $col, $val)
    {
        $this->grid[$row][$col] = $val;
        return $this->getSquare($row, $col);
    }

    public function isFull()
    {
        for($i = 0; $i < $this->dimension; $i++) {
            for($j = 0; $j < $this->dimension; $j++) {
                if(self::NOTHING == $this->getSquare($i, $j)) {
                    return false;
                }
            }
        }
        return true;
    }

    public function isEmpty()
    {
        for($i = 0; $i < $this->dimension; $i++) {
            for($j = 0; $j < $this->dimension; $j++) {
                if(self::NOTHING != $this->getSquare($i, $j)) {
                    return false;
                }
            }
        }
        return true;
    }

    public function loadBoard($grid)
    {
        $this->grid = $grid;
    }

    public function isBoardWon()
    {
        $res = false;

        for($i = 0; $i < $this->dimension; $i++) {
            $res = $res || $this->isColWon($i) || $this->isRowWon($i);
        }

        $res = $res || $this->isMainDiagonWon();
        $res = $res || $this->isSecondDiagonWon();

        if(!$res) {
            $this->clearBoardColor();
        }

        return $res;
    }

    public function isRowWon($row)
    {
        $this->clearBoardColor();
        $this->setBoardColor($row, 0);
        $square = $this->getSquare($row, 0);

        if(self::NOTHING == $square) {
            return false;
        }

        for($i = 1; $i < $this->dimension; $i++) {
            if($square != $this->getSquare($row, $i)) {
               return false;
            }
            $this->setBoardColor($row, $i);
        }

        return true;
    }

    public function isColWon($col)
    {
        $this->clearBoardColor();
        $this->setBoardColor(0, $col);
        $square = $this->getSquare(0, $col);

        if(self::NOTHING == $square) {
            return false;
        }

        for($i = 1; $i < $this->dimension; $i++) {
            if($square != $this->getSquare($i, $col)) {
                return false;
            }

            $this->setBoardColor($i, $col);
        }
        return true;
    }

    public function isMainDiagonWon()
    {
        $this->clearBoardColor();
        $this->setBoardColor(0, 0);
        $square = $this->getSquare(0, 0);

        if(self::NOTHING == $square) {
            return false;
        }
        for($i = 1; $i < $this->dimension; $i++) {
            if($square != $this->getSquare($i, $i)) {
                return false;
            }

            $this->setBoardColor($i, $i);
        }
        return true;
    }

    public function isSecondDiagonWon()
    {
        $length = $this->dimension - 1;

        $this->clearBoardColor();
        $this->setBoardColor(0, $length);
        $square = $this->getSquare(0, $length);

        if(self::NOTHING == $square) {
            return false;
        }

        $i = 0;

        for($j = 0; $j < $length; $j++) {
            $i++;

            if($square != $this->getSquare($this->dimension - $i,$j)){
                return false;
            }

            $this->setBoardColor($this->dimension - $i, $j);
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function getGrid()
    {
        return $this->grid;
    }

    public function setBoardColor($row, $col){
        $this->boardColor[] = $row .','. $col;
    }

    public function getBoardColor(){
        return $this->boardColor;
    }

    public function clearBoardColor(){
        $this->boardColor = array();
    }
}