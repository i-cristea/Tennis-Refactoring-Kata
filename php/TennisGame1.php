<?php

class TennisGame1 implements TennisGame
{
    private $gameScore1 = 0;
    private $gameScore2 = 0;
    private $player1 = '';
    private $player2 = '';

    public function __construct($player1, $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function wonPoint($playerName)
    {
        if ('player1' == $playerName) {
            $this->gameScore1++;
        } else {
            $this->gameScore2++;
        }
    }

    public function getScore()
    {
        if ($this->gameScore1 == $this->gameScore2) {
            return $this->getEqualityScore();
        }

        if ($this->gameScore1 >= 4 || $this->gameScore2 >= 4) {
            return $this->getWinOrAdvantage();
        }

        return $this->getTempScore($this->gameScore1) . '-' . $this->getTempScore($this->gameScore2);
    }

    private function getEqualityScore(): string
    {
        if ($this->gameScore1 > 2) {
            return "Deuce";
        }

        return $this->getTempScore($this->gameScore1) . "-All";
    }

    private function getWinOrAdvantage(): string
    {
        $minusResult = $this->gameScore1 - $this->gameScore2;
        $result = $this->getResult($minusResult);
        if ($minusResult > 0) {
            return $result . "player1";
        }

        return $result . "player2";
    }

    private function getResult($difference): string
    {
        if (abs($difference) === 1) {
            return "Advantage ";
        }

        return "Win for ";
    }

    private function getTempScore($score): string
    {
        switch ($score) {
            case 0:
                $score = "Love";
                break;
            case 1:
                $score = "Fifteen";
                break;
            case 2:
                $score = "Thirty";
                break;
            case 3:
                $score = "Forty";
                break;
        }

        return $score;
    }
}

