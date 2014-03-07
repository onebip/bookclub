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

    public function test300IsTrecento()
    {
        $expected = 'trecento';
        $numberTranslate = new NumberTranslate(300);
        $this->assertEquals($expected,$numberTranslate->numberToLetter());
    }
}

class NumberTranslate
{
    private $mapSingle = [
        '0' => '',
        '1' => 'uno',
        '3' => 'tre',
        '9' => 'nove',
    ];
    private $cento = 'cento';
    private $mapDouble = [
        '90' => 'novanta',
        '0' => 'cento'
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
        switch(strlen($this->number)) {
        case 2:
            $key1 = $this->giveMeCharAt(0).'0';
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
                $this->mapSingle[$key1],
                $this->mapDouble[$key2],
                $this->mapSingle[$key3]
            ]);
            break;
        default:
            return $this->mapSingle[$this->number];
        }
    }
}
