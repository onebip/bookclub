<?php

class MineSweeper
{
    public function verificaRigheDelCampoDiGioco($board)
    {
        $numeroRighe = explode(' ', $board[0])[0];
        return (count($board) == $numeroRighe + 1);
    }

    private function _verificaColonneDelCampoDiGioco($board, $numColonne)
    {
        if (count($board) == 0)
        {
            return true;
        }
        $row = array_shift($board);
        return ((strlen($row) == $numColonne + 1) && ($this->_verificaColonneDelCampoDiGioco($board, $numColonne)));
    }

    public function verificaColonneDelCampoDiGioco($board)
    {
        $numeroColonne = explode(' ', $board[0])[1];
        unset($board[0]);
        return $this->_verificaColonneDelCampoDiGioco($board, $numeroColonne);
    }

    public function preparaCampoDiGioco($board)
    {
        $result = [];
        unset($board[0]);
        foreach($board as $row)
        {
            $caselle = str_split($row);
            array_pop($caselle);
            $result[] = $caselle;
        }
        return $result;
    }

    public function isBomb($casella)
    {
        return ($casella == '*');
    }

    public function bombeAttorno($riga, $colonna, $campoDiGioco)
    {
        if ($this->isBomb($campoDiGioco[$riga][$colonna])) return '*';
        $contaBombe = 0;
        for ($row = $riga -1; $row <= $riga + 1; $row++)
        {
            if ($row < 0 || $row > count($campoDiGioco)) continue;
            for ($col = $colonna -1; $col <= $colonna + 1; $col++)
            {
                if ($col < 0 || $col > count($campoDiGioco[0])) continue;
                if ($this->isBomb($campoDiGioco[$row][$col]))
                {
                    $contaBombe++;
                }
            }
        }
    }
}
