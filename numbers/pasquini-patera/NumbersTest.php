<?php

class NumbersTest extends PHPUnit_Framework_TestCase 
{

    public function test1IsUno()
    {
        $expected = 'uno';
        $numberTranslate = new NumberTranslate(1);
        $this->assertEquals($expected,$numberTranslate->numberToLetter());
    }

    public function test99IsNovantanove()
    {
        $expected = 'novantanove';
        $numberTranslate = new NumberTranslate(99);
        $this->assertEquals($expected,$numberTranslate->numberToLetter());
    }

    public function test23IsVentitre()
    {
        $expected = 'ventitre';
        $numberTranslate = new NumberTranslate(23);
        $this->assertEquals($expected,$numberTranslate->numberToLetter());
    }

    public function test13IsTredici()
    {
        $expected = 'tredici';
        $numberTranslate = new NumberTranslate(13);
        $this->assertEquals($expected,$numberTranslate->numberToLetter());
    }

    public function test300IsTrecento()
    {
        $expected = 'trecento';
        $numberTranslate = new NumberTranslate(300);
        $this->assertEquals($expected,$numberTranslate->numberToLetter());
    }

    public function test310IsTrecentodieci()
    {
        $expected = 'trecentodieci';
        $numberTranslate = new NumberTranslate(310);
        $this->assertEquals($expected,$numberTranslate->numberToLetter());
    }

}

class NumberTranslate
{
    private $cento = 'cento';
    private $mapSingle = [
        '0' => '',
        '1' => 'uno',
        '3' => 'tre',
        '9' => 'nove',
    ];
    private $mapTeenager = [
        '11' => 'undici',
        '12' => 'dodici',
        '13' => 'tredici',
        '14' => 'quattordici',
        '15' => 'quindici',
        '16' => 'sedici',
        '17' => 'diciasette',
        '18' => 'diciotto',
        '19' => 'diciannove'
    ];
    private $mapDouble = [
        '0' => '',
        '1' => 'dieci',
        '2' => 'venti',
        '3' => 'trenta',
        '4' => 'quaranta',
        '5' => 'cinquanta',
        '6' => 'sesanta',
        '7' => 'settanta',
        '8' => 'ottanta',
        '9' => 'novanta',
    ];

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function numberToLetter()
    {
        return $this->translate();
    }

    private function giveMeCharAt($position)
    {
        return substr($this->number,$position,1);
    }

    private function finalResponse(array $values)
    {
        $result = '';
        foreach($values as $value)
        {
            $result .= $value;
        }
        return $result;
    }

    private function translate()
    {
        if ($this->number >= 11 && $this->number <=19) {
            return $this->mapTeenager[$this->number];
        }


        switch(strlen($this->number)) {
        case 2:
            $key1 = $this->giveMeCharAt(0);
            $key2 = $this->giveMeCharAt(1);
            return $this->finalResponse([
                $this->mapDouble[$key1],
                $this->mapSingle[$key2]
            ]);
            break;
        case 3:
            $key1 = $this->giveMeCharAt(0);
            $key2 = $this->giveMeCharAt(1);
            $key3 = $this->giveMeCharAt(2);
            return $this->finalResponse([
                $this->mapSingle[$key1].$this->cento,
                $this->mapDouble[$key2],
                $this->mapSingle[$key3]
            ]);
            break;
        default:
            return $this->mapSingle[$this->number];
        }
    }
}
