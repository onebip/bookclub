<?php
namespace NumbersOfInterest;

use NumbersOfInterest\Algebraist;
use NumbersOfInterest\Options;
use NumbersOfInterest\SeriesArrayToConsoleLine;

require_once __DIR__ . '/Algebraist.php';

class AlgebraistTest extends \PHPUnit_Framework_TestCase
{
    public function testNumbersOfInterestAreFound()
    {
        $numberOfSeries = 1;
        $this->assertEquals(
            [[2, 2, 2, 6, 10, 18, 34]],
            Algebraist::calculate(
                new Options(
                    "$numberOfSeries" . PHP_EOL . $this->seriesInput()
                )
            )
        );
    }

    public function testNumbersOfInterestAreFoundEvenWith2Series()
    {
        $numberOfSeries = 2;

        $expectedSeriesOutput = [ 
            [2, 2, 2, 6, 10, 18, 34],
            [4, 4, 4, 4, 4, 4, 4, 4, 4, 36, 68, 132]
        ];

        $this->assertEquals(
            $expectedSeriesOutput,
            Algebraist::calculate(
                new Options(
                    $numberOfSeries . PHP_EOL . $this->seriesInput() . PHP_EOL . $this->seriesInput(9, 4, 12)
                )
            )
        );
    }

    public function testNumbersOfInterestConsoleOutputWithDoubleSeries()
    {
        $numberOfSeries = 2;

$expectedSeriesOutput = <<<EOT
2, 2, 2, 6, 10, 18, 34
4, 4, 4, 4, 4, 4, 4, 4, 4, 36, 68, 132
EOT;
        $this->assertEquals(
            $expectedSeriesOutput,
            SeriesArrayToConsoleLine::output(
                Algebraist::calculate(
                    new Options(
                        $numberOfSeries . PHP_EOL . $this->seriesInput() . PHP_EOL . $this->seriesInput(9, 4, 12)
                    )
                )
            )
        );
    }

    public function testNumbersOfInterestConsoleOutputWithSingleSeries()
    {
        $numberOfSeries = 1;
        $this->assertEquals(
            '2, 2, 2, 6, 10, 18, 34',
            SeriesArrayToConsoleLine::output(
                Algebraist::calculate(
                    new Options(
                        "$numberOfSeries" . PHP_EOL . $this->seriesInput()
                    )
                )
            )
        );
    }

    private function seriesInput(
        $occurencesOfReferenceNumber=3,
        $referenceNumber=2,
        $totalOfNumbers=7
    )
    {
        return "$occurencesOfReferenceNumber $referenceNumber $totalOfNumbers"; 
    }
}
