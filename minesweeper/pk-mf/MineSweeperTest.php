<?php
require_once "MineSweeper.php";

class MineSweeperTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->board = file(__DIR__ . '/board.log');
        $this->minesweeper = new MineSweeper();
    }

    public function testFalseIsFalse()
    {
        $this->assertFalse(false);
    }

    public function testCalcolaRigheCampo()
    {
        $this->assertEquals(5, count($this->board));
    }

    public function testVerificaRigheDelCampoDiGioco()
    {
        $this->assertTrue($this->minesweeper->verificaRigheDelCampoDiGioco($this->board));
    }

    public function testVerificaColonneDelCampoDiGioco()
    {
        $this->assertTrue($this->minesweeper->verificaColonneDelCampoDiGioco($this->board));
    }

    public function testVerificoISimboliNelleCaselle()
    {
        $campoDiGioco = $this->minesweeper->preparaCampoDiGioco($this->board);
        $this->assertEquals('*', $campoDiGioco[0][0]);
        $this->assertEquals('.', $campoDiGioco[0][3]);
        $this->assertEquals('.', $campoDiGioco[1][1]);
        $this->assertEquals('*', $campoDiGioco[2][1]);
        $this->assertEquals('.', $campoDiGioco[2][2]);
        $this->assertEquals('.', $campoDiGioco[3][3]);

        $this->assertTrue($this->minesweeper->isBomb($campoDiGioco[2][1]));
        $this->assertFalse($this->minesweeper->isBomb($campoDiGioco[0][3]));
    }

    public function testBombeAttorno()
    {
        $campoDiGioco = $this->minesweeper->preparaCampoDiGioco($this->board);
        $this->assertEquals('*', $this->minesweeper->bombeAttorno(0, 0, $campoDiGioco));
        $this->assertEquals('0', $this->minesweeper->bombeAttorno(0, 3, $campoDiGioco));
        //$this->assertEquals('1', $this->minesweeper->bombeAttorno(1, 2, $campoDiGioco));
    }
}
