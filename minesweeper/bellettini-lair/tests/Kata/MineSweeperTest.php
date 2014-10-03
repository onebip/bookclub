<?php
namespace Kata;

class MineSweeperTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->ms = new MineSweeper();
    }

    public function testOnePerOneCleanFieldIsZero()
    {
        $this->assertEquals(
            'Field #1' . PHP_EOL .
            '0',

            $this->ms->run('1 1' . PHP_EOL . '.')
        );
    }

    public function testOnePerOneMinedFieldIsAsterisk()
    {
        $this->assertEquals(
            'Field #1' . PHP_EOL . '*',
            $this->ms->run('1 1' . PHP_EOL . '*')
        );
    }

    public function testOnePerTwoFieldWithOneMineIsAsteriskAndOne()
    {
        $this->assertEquals(
            'Field #1' . PHP_EOL . '*1',
            $this->ms->run('1 2' . PHP_EOL . '*.')
        );
    }

    public function testMoreComplexMine()
    {
        $mine = <<<EOT
2 4
*...
*...
EOT;

        $expected = <<<EOT
Field #1
*200
*200
EOT;

        $this->assertEquals(
            $expected,
            $this->ms->run($mine)
        );
    }
}
