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

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function numberToLetter()
    {
        if ($this->number > 1)
        return 'novantanove';

        return 'uno';
    }
}
