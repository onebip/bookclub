<?php

require_once 'Convertitore.php';

class ConvertitoreTest extends \PHPUnit_Framework_TestCase
{

    private $convertitore;

    public function setUp()
    {
        $this->convertitore = new Convertitore();
    }

    public static function numeriERappresentazioneInLettere()
    {
        return [
            [1, 'uno'],
            [2, 'due'],
            [3, 'tre'],
            [20, 'venti'],
            [22, 'ventidue'],
        ];
    }

    /**
     * @dataProvider numeriERappresentazioneInLettere
     */
    public function testConverteUno($integer, $inLettere)
    {
        $this->assertEquals(
            $inLettere, 
            $this->convertitore
                 ->__invoke($integer)
        );
    }

    public function testNumeroAUnaCifra()
    {
        $sette = new Numero(7);
        $this->assertEquals(7, $sette->units());
        $this->assertEquals(0, $sette->tens());
    }

    public function testNumeroADueCifre()
    {
        $sette = new Numero(17);
        $this->assertEquals(7, $sette->units());
        $this->assertEquals(1, $sette->tens());
    }

}
