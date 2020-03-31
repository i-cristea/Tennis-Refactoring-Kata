<?php

class TennisGame2 implements TennisGame
{
    private const SCORE = ["Love", "Fifteen", "Thirty", "Forty"];
    private const ALL = "All";
    private const DEUCE = "Deuce";
    private $pointPlayer1 = 0;
    private $pointPlayer2 = 0;

    private $resultPlayer1 = "";
    private $resultPlayer2 = "";
    private $namePlayer1 = "";
    private $nameplayer2 = "";

    public function __construct($player1Name, $player2Name)
    {
        $this->namePlayer1 = $player1Name;
        $this->nameplayer2 = $player2Name;
    }

    private function getPointScore($point): string
    {
        if ($point < 4) {
            return self::SCORE[$point];
        }

        return "";
    }

    private function getEqualsScore(): string
    {
        if ($this->pointPlayer1 >= 3) {
            return self::DEUCE;
        }

        return $this->resultPlayer1 . "-" . self::ALL;
    }

    private function getWinOrAdvantageScore(): ?string
    {
        $diff = $this->pointPlayer1 - $this->pointPlayer2;
        $score = (abs($diff) == 1) ? "Advantage " : "Win for ";

        if ($diff > 0) {
            return $score . "player1";
        }

        return $score . "player2";
    }

    public function getScore()
    {
        $this->resultPlayer1 = $this->getPointScore($this->pointPlayer1);
        $this->resultPlayer2 = $this->getPointScore($this->pointPlayer2);

        if ($this->pointPlayer1 == $this->pointPlayer2) {
            return $this->getEqualsScore();
        }
        if ($this->pointPlayer1 > 3 || $this->pointPlayer2 > 3) {
            return $this->getWinOrAdvantageScore();
        }
        return "{$this->resultPlayer1}-{$this->resultPlayer2}";
    }

    private function player1Score()
    {
        $this->pointPlayer1++;
    }

    private function player2Score()
    {
        $this->pointPlayer2++;
    }

    public function wonPoint($player)
    {
        $addPoints = $player . 'Score';
        $this->$addPoints();
    }
}
