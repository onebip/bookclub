<?php

class NumeriInParoleTest extends \PHPUnit_Framework_TestCase
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

    public function secondaDecina()
    {
        return [
            [10, "dieci"],
            [11, "undici"],
            [12, "dodici"],
            [13, "tredici"],
            [14, "quattordici"],
            [15, "quindici"],
            [16, "sedici"],
            [17, "diciassette"],
            [18, "diciotto"],
            [19, "diciannove"],
        ];
    }

    public function terzaDecina()
    {
        return [
            /* [20, "venti"], */
            [21, "ventuno"],
            [22, "ventidue"],
            [23, "ventitre"],
            [24, "ventiquattro"],
            [25, "venticinque"],
            [26, "ventisei"],
            [27, "ventisette"],
            /* [28, "ventotto"], */
            /* [29, "ventinove"], */
        ];
    }

    /**
     * @dataProvider unita
     */
    public function testUnita($input, $output)
    {
        $numero = Numero::daCifra($input);
        $this->assertEquals($output, $numero);
    }

    /**
     * @dataProvider secondaDecina
     */
    public function testSecondaDecina($input, $output)
    {
        $numero = Numero::daCifra($input);
        $this->assertEquals($output, $numero);
    }

    /**
     * @dataProvider terzaDecina
     */
    public function testTerzaDecina($input, $output)
    {
        $numero = Numero::daCifra($input);
        $this->assertEquals($output, $numero->__toString());
    }

    public function test99IsNovantaNove()
    {
        $this->markTestSkipped();
        $numero = Numero::daCifra($input);
        $this->assertEquals("novantanove", $numero);
    }

    public function testStringaCheIniziaConVocaleRestituisceVero()
    {
        $numero = Numero::daCifra(8);
        $this->assertTrue($numero->iniziaConVocale('otto'));
    }

    public function testStringaCheIniziaConConsonanteRestituisceFalso()
    {
        $numero = Numero::daCifra(9);
        $this->assertFalse($numero->iniziaConVocale('nove'));
    }
}
