<?php

class NumbersTest extends PHPUnit_Framework_TestCase 
{

    public function test1IsUno()
    {
        $expected = 'uno';
        $numberTranslate = new NumberTranslate(1);
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
        return 'uno';
    }
}
