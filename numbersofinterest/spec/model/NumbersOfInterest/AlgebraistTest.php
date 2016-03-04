<?php
namespace NumbersOfInterest;

use UI\Options;
use UI\SeriesArrayToConsoleLine;

require_once __DIR__ . '/../../../model/NumbersOfInterest/Algebraist.php';

class AlgebraistTest extends \PHPUnit_Framework_TestCase
{
    private $algebraist;

    public function setUp()
    {
        $this->algebraist = new Algebraist();    
        $this->seriesArrayToConsoleLine = new SeriesArrayToConsoleLine();
    }

    public function testNumbersOfInterestAreFound()
    {
        $numberOfSeries = 1;
        $this->assertEquals(
            [[2, 2, 2, 6, 10, 18, 34]],
            $this->algebraist->calculate(
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
            $this->algebraist->calculate(
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
            $this->seriesArrayToConsoleLine->output(
                $this->algebraist->calculate(
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
            $this->seriesArrayToConsoleLine->output(
                $this->algebraist->calculate(
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
