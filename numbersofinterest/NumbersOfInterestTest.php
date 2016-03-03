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
        $numberOfSeries = 1;

        $input = "$numberOfSeries" . PHP_EOL . "$x $y $n"; 

        $this->assertEquals(
            '2, 2, 2, 6, 10, 18, 34',
            SeriesArrayToConsoleLine::output(
                NumbersOfInterest::calculate($input)
            )
        );
    }

    public function testNumbersOfInterestAreFoundEvenWith2Series()
    {
        $numberOfSeries = 2;
        $x = 3;
        $y = 2;
        $n = 7;
        $firstSerieTestCase = "$x $y $n";
        $x = 9;
        $y = 4;
        $n = 12;
        $secondSerieTestCase = "$x $y $n";

        $input = <<<EOT
$numberOfSeries
$firstSerieTestCase
$secondSerieTestCase
EOT;

$expectedSeriesOutput = <<<EOT
2, 2, 2, 6, 10, 18, 34
4, 4, 4, 4, 4, 4, 4, 4, 4, 36, 68, 132
EOT;
        $this->assertEquals(
            $expectedSeriesOutput,
            SeriesArrayToConsoleLine::output(
                NumbersOfInterest::calculate($input)
            )
        );
    }
}
