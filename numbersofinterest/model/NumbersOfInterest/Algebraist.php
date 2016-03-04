<?php
namespace NumbersOfInterest;

require_once __DIR__ . '/../../ui/InputOutputOperations/SeriesArrayToConsoleLine.php';
require_once __DIR__ . '/../../ui/InputOutputOperations/Options.php';
use UI\Options;

class Algebraist
{
    public function calculate(Options $options)
    {
        $series = [];

        foreach ($options->all() as $seriesOption) {
            $series[] = self::calculateSeriesSequence($seriesOption);
        }

        return $series;
    }

    private function calculateSeriesSequence($seriesOption)
    {
        $properties = SeriesProperties::fromArray($seriesOption);

        // first part of the series, fulfill reference number X occurences times 
        $currentSeries = array_fill(0, $properties->occurencesOfReferenceNumber, $properties->referenceNumber);

        for ($cursor=0; $cursor< ($properties->totalOfNumbers-$properties->occurencesOfReferenceNumber); $cursor++) {
            // adding sum at position cursor + occurencesOfReferenceNumber
            $currentSeries[$cursor+$properties->occurencesOfReferenceNumber] = $this->sumUntil($properties->occurencesOfReferenceNumber, $currentSeries, $cursor);
        }

        return $currentSeries;
    }

    private function sumUntil($occurencesOfReferenceNumber, array $currentSeries, $cursor)
    {
        $sum = 0;
        for ($z=0; $z<$occurencesOfReferenceNumber; $z++) {
            $sum += $currentSeries[$z+$cursor]; 
        }
    
        return $sum;
    }
}
