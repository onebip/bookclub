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
}

class NumberTranslate
{
    private $mapSingle = [
        '1' => 'uno',
        '9' => 'nove',
    ];
    
    private $mapDouble = [
        '90' => 'novanta'
    ];

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function numberToLetter()
    {
        return $this->translate();
    }

    private function translate()
    {
        $numberOfChar = strlen($this->number);
        if ($numberOfChar == 2) {
            $key1 = substr($this->number,0,1).'0';
            $key2 = substr($this->number,1,2);
            return $this->mapDouble[$key1].$this->mapSingle[$key2];
        }

        if ($numberOfChar == 1) {
            return $this->mapSingle[$this->number];
        }
    }
}
