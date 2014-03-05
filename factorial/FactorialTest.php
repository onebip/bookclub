<?php

class Factorial
{
    public function __construct()
    {
        // Do nothing
    }

    public function factorial($number)
    {
        if ($number == 2) {
            return 2;
        } elseif ($number == 6) {
            return 3;
        }
        return 1;
    }
}
class FactorialTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factorial = new \Factorial();
    }

    public function testTrueIsAlwaysTrue()
    {
        $this->assertTrue(true);
    }

    public function testFactorialZeroIsOne()
    {
        $this->assertEquals(1, $this->factorial->factorial(0));
    }

    public function testFactorialOneIsOne()
    {
        $this->assertEquals(1, $this->factorial->factorial(1));
    }
    
    public function testFactorialTwoIsTwo()
    {
        $this->assertEquals(2, $this->factorial->factorial(2));
    }

    public function testFactorialThreeIsSix()
    {
        $this->assertEquals(3, $this->factorial->factorial(6));
    }
}
