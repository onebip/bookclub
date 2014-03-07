<?php
require_once __DIR__ . '/ArabicNumbersToItalianWord.php';

class TestArabicNumbersToItalian extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->arabicNumbersToItalianWord = new ArabicNumbersToItalianWord();
    }

    public function testTrueIsAlwaysTrue()
    {
        $this->assertTrue(true);
    }

    public function test1IsTranslatedByUno()
    {
        $this->assertEquals(
            'uno',
            $this->arabicNumbersToItalianWord->translate(1)
        );
    }

    public function test99IsTranslatedByNovantanove()
    {
        $this->assertEquals(
            'novantanove',
            $this->arabicNumbersToItalianWord->translate(99)
        );
    }

    public function test300IsTranslatedByTrecento()
    {
        $this->assertEquals(
            'trecento',
            $this->arabicNumbersToItalianWord->translate(300)
        );
    }

    public function test310IsTranslatedByTrecentodieci()
    {
        $this->assertEquals(
            'trecentodieci',
            $this->arabicNumbersToItalianWord->translate(310)
        );
    }

    public function test1501IsTranslatedByMilleCinqueCentoUno()
    {
        $this->assertEquals(
            'mille cinque cento uno',
            $this->arabicNumbersToItalianWord->translate(1501)
        );
    }

    public function test12609IsTranslatedByDodiciMillaSeiCentoNove()
    {
        $this->assertEquals(
            'dodici milla sei cento nove',
            $this->arabicNumbersToItalianWord->translate(12609)
        );
    }

    public function test425454IsTranslatedByQuattroCentoMillaVenticinqueQuattroCentoCinquantaQuattro()
    {
        $this->assertEquals(
            'quattro cento venticinque quattro milla quattro cento cinquanta quattro',
            $this->arabicNumbersToItalianWord->translate(425454)
        );
    }

    public function test100001IsTranslatedByUnMillioneEUno()
    {
        $this->assertEquals(
            'un millione e uno',
            $this->arabicNumbersToItalianWord->translate(100001)
        );
    }
}
