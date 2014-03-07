<?php

class UnitaTest extends \PHPUnit_Framework_TestCase
{
    public function unita()
    {
        return [
            [0, "zero"],
            [1, "uno"],
            [2, "due"],
            [3, "tre"],
            [4, "quattro"],
            [5, "cinque"],
            [6, "sei"],
            [7, "sette"],
            [8, "otto"],
            [9, "nove"],
        ];
    }

    /**
     * @dataProvider unita
     */
    public function testUnita($input, $output)
    {
        $numero = new Unita($input);
        $this->assertEquals($output, $numero);
    }
}
