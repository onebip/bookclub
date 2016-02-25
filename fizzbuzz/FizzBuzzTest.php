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
        $this->fizzBuzz = new FizzBuzz([
            new MultipleKnowledge(3, 'Fizz'),
            new MultipleKnowledge(5, 'Buzz'),
            //new MultipleKnowledge(7, 'Bang'),
        ]);
    }

    public function test0IsAMutipleOf3And5()
    {
        $this->assertEquals(
            'FizzBuzz' . PHP_EOL,
            FizzBuzzPrettyString::output($this->fizzBuzz, 0)
        );
    }

    public function test1IsNotAMutipleOf3And5()
    {
        $this->assertEquals(
            1 . PHP_EOL,
            FizzBuzzPrettyString::output($this->fizzBuzz, 1)
        );
    }

    public function test2IsNotAMutipleOf3And5()
    {
        $this->assertEquals(
            2 . PHP_EOL,
            FizzBuzzPrettyString::output($this->fizzBuzz, 2)
        );
    }

    public function test3IsAMutipleOf3()
    {
        $this->assertEquals(
            'Fizz' . PHP_EOL,
            FizzBuzzPrettyString::output($this->fizzBuzz, 3)
        );
    }

    public function test5IsAMutipleOf5()
    {
        $this->assertEquals(
            'Buzz' . PHP_EOL,
            FizzBuzzPrettyString::output($this->fizzBuzz, 5)
        );
    }

    public function test6IsAMutipleOf3()
    {
        $this->assertEquals(
            'Fizz' . PHP_EOL,
            FizzBuzzPrettyString::output($this->fizzBuzz, 6)
        );
    }

    public function test10IsAMutipleOf5()
    {
        $this->assertEquals(
            'Buzz' . PHP_EOL,
            FizzBuzzPrettyString::output($this->fizzBuzz, 10)
        );
    }

    public function test15IsAMutipleOf3And5()
    {
        $this->assertEquals(
            'FizzBuzz' . PHP_EOL,
            FizzBuzzPrettyString::output($this->fizzBuzz, 15)
        );
    }

    public function test30IsAMutipleOf3And5()
    {
        $this->assertEquals(
            'FizzBuzz' . PHP_EOL,
            FizzBuzzPrettyString::output($this->fizzBuzz, 30)
        );
    }
}
