<?php

require_once __DIR__ . '/NumbersOfInterest.php';

class NumbersOfInterestTest extends PHPUnit_Framework_TestCase
{
    public function testNumbersOfInterestAreFound()
    {
        // 0 < X < 50
        $x = 3;

        // 0 <= Y < 3
        $y = 2;

        // 0 < N <= 50
        $n = 7;

        // 1 <= T <= 10^6
        $numberOfTestCases = 1;

        $input = "$numberOfTestCases" . PHP_EOL . "$x $y $n"; 

        $this->assertEquals(
            '2, 2, 2, 6, 10, 18, 34',
            NumbersOfInterest::calculate($input)
        );
    }
}
