<?php
namespace NumbersOfInterest;

require_once __DIR__ . '/SeriesArrayToConsoleLine.php';
require_once __DIR__ . '/Options.php';

use NumbersOfInterest\Options;
use NumbersOfInterest\SeriesProperties;

class Algebraist
{
    public static function calculate(Options $options)
    {
        $series = [];

        foreach ($options->toArray() as $seriesOption) {
            $series[] = self::calculateSeriesSequence($seriesOption);
        }

        return $series;
    }

    private static function calculateSeriesSequence($seriesOption)
    {
        $properties = SeriesProperties::fromArray($seriesOption);

        // first part of the series, fulfill reference number X occurences times 
        $currentSeries = array_fill(0, $properties->occurencesOfReferenceNumber, $properties->referenceNumber);

        for ($cursor=0; $cursor< ($properties->totalOfNumbers-$properties->occurencesOfReferenceNumber); $cursor++) {
            // adding sum at position cursor + occurencesOfReferenceNumber
            $currentSeries[$cursor+$properties->occurencesOfReferenceNumber] = self::sumUntil($properties->occurencesOfReferenceNumber, $currentSeries, $cursor);
        }

        return $currentSeries;
    }

    private static function sumUntil($occurencesOfReferenceNumber, array $currentSeries, $cursor)
    {
        $sum = 0;
        for ($z=0; $z<$occurencesOfReferenceNumber; $z++) {
            $sum += $currentSeries[$z+$cursor]; 
        }
    
        return $sum;
    }
}
