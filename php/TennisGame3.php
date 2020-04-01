<?php

class TennisGame3 implements TennisGame
{
    private const POINTS = ["Love", "Fifteen", "Thirty", "Forty"];
    private const DEUCE = "Deuce";
    private const ALL = "All";
    private const SEPARATOR = "-";
    private $pointsPlayer2 = 0;
    private $pointsPlayer1 = 0;
    private $namePlayer1 = '';
    private $namePlayer2 = '';

    public function __construct($namePlayer1, $namePlayer2)
    {
        $this->namePlayer1 = $namePlayer1;
        $this->namePlayer2 = $namePlayer2;
    }

    public function getScore()
    {
        if ($this->pointsPlayer1 == $this->pointsPlayer2) {
            return $this->getEqualsScore();
        }

        if ($this->pointsPlayer1 > 3 || $this->pointsPlayer2 > 3) {
            return $this->getWinOrAdvantage();
        }

        return $this->getPlayerScore($this->pointsPlayer1) .
            self::SEPARATOR .
            $this->getPlayerScore($this->pointsPlayer2);
    }

    private function getEqualsScore()
    {
        if ($this->pointsPlayer1 > 2) {
            return self::DEUCE;
        }
        return $this->getPlayerScore($this->pointsPlayer1) . self::SEPARATOR . self::ALL;
    }

    private function getPlayerScore($player): string
    {
        return self::POINTS[$player];
    }

    private function getWinOrAdvantage(): string
    {
        $scoreDifference = $this->pointsPlayer1 - $this->pointsPlayer2;
        $name = $scoreDifference > 0 ? $this->namePlayer1 : $this->namePlayer2;

        if (abs($scoreDifference) == 1) {
            return "Advantage {$name}";
        }
        return "Win for {$name}";
    }

    public function wonPoint($playerName)
    {
        if ($playerName == $this->namePlayer1) {
            $this->pointsPlayer1++;
        } else {
            $this->pointsPlayer2++;
        }
    }

}

