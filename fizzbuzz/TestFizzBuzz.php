<?php

require_once __DIR__ . '/FizzBuzz.php';

class TestFizzBuzz extends PHPUnit_Framework_TestCase
{ 
    /*
     * Print the numbers 1..100
     * For multiples of 3, print "Fizz" instead of the number
     * For multiples of 5, print "Buzz" instead of the number
     * For multiples of 3 and 5, print "FizzBuzz" instead of the number
     * Else it returns the number and a new line
     */

    /**
     * @dataProvider listOfNumbers
     */
    public function testGivenOneNumberThenItReturnsOne($givenNumber, $expectedOutput)
    {
        $fizzBuzz = new FizzBuzz();
        $this->assertEquals($expectedOutput, $fizzBuzz->check($givenNumber));
    }

    public static function listOfNumbers()
    {
        $listOfNumbers = [];

        for ($counter=1; $counter<=100; $counter++) {
            if ($counter % 3 === 0 && $counter % 5 === 0) {
                $listOfNumbers[] = [$counter, 'FizzBuzz' . PHP_EOL];
            } elseif ($counter % 3 === 0) {
                $listOfNumbers[] = [$counter, 'Fizz' . PHP_EOL];
            } elseif ($counter % 5 === 0) {
                $listOfNumbers[] = [$counter, 'Buzz' . PHP_EOL];
            } else {
                $listOfNumbers[] = [$counter, $counter . PHP_EOL];
            }
        }

        return $listOfNumbers;
    }
}
