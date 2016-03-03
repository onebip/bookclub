<?php
 /*
  * Print the numbers 1..100
  * For multiples of 3, print "Fizz" instead of the number
  * For multiples of 5, print "Buzz" instead of the number
  * For multiples of 3 and 5, print "FizzBuzz" instead of the number
  * Else it returns the number and a new line
  */

require_once __DIR__ . '/FizzBuzz.php';

class TestFizzBuzz extends PHPUnit_Framework_TestCase
{ 
    private $fizzBuzz;

    public function setUp()
    {
        $this->fizzBuzz = new FizzBuzz(
            [
                Rule::fromFactorAndOutput(3, 'Fizz'),
                Rule::fromFactorAndOutput(5, 'Buzz'),
            ],
            [
                new PositiveIntegerValidator()
            ]
        );
    }

    public function test0IsAMultipleOf3And5()
    {
        $this->assertEquals(
            'FizzBuzz',
            $this->fizzBuzz->play(0)
        );
    }

    public function test1IsNotAMultipleOf3And5()
    {
        $this->assertEquals(
            1,
            $this->fizzBuzz->play(1)
        );
    }

    public function test2IsNotAMultipleOf3And5()
    {
        $this->assertEquals(
            2,
            $this->fizzBuzz->play(2)
        );
    }

    public function test3IsAMultipleOf3()
    {
        $this->assertEquals(
            'Fizz',
            $this->fizzBuzz->play(3)
        );
    }

    public function test5IsAMultipleOf5()
    {
        $this->assertEquals(
            'Buzz',
            $this->fizzBuzz->play(5)
        );
    }

    public function test6IsAMultipleOf3()
    {
        $this->assertEquals(
            'Fizz',
            $this->fizzBuzz->play((3 * 2))
        );
    }

    public function test10IsAMultipleOf5()
    {
        $this->assertEquals(
            'Buzz',
            $this->fizzBuzz->play((5 * 2))
        );
    }

    public function test15IsAMultipleOf3And5()
    {
        $this->assertEquals(
            'FizzBuzz',
            $this->fizzBuzz->play((3 * 5))
        );
    }

    public function test30IsAMultipleOf3And5()
    {
        $this->assertEquals(
            'FizzBuzz',
            $this->fizzBuzz->play((3 * 5 * 2))
        );
    }

    public function test60IsAMultipleOf3And5()
    {
        $this->assertEquals(
            'FizzBuzz',
            $this->fizzBuzz->play((3 * 5 * 4))
        );
    }

    /**
     * @expectedException InvalidArgumentException 
     */
    public function testMinus1IsNotAMultipleOf3And5()
    {
        $this->fizzBuzz->play(-1);
    }

    /**
     * @expectedException InvalidArgumentException 
     */
    public function testEmptyInputIsNotAMultipleOf3And5()
    {
        $this->fizzBuzz->play('');
    }

    public function testConsoleSingleLinePrintsFizzBuzzOutputCorrectly()
    {
        $this->assertEquals(
            'FizzBuzz' . PHP_EOL,
            ConsoleSingleLine::output($this->fizzBuzz->play((3 * 5)))
        );
    }
}
