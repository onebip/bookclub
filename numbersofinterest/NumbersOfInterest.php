<?php

class NumbersOfInterest
{
    public static function calculate($input)
    {
        $lines = explode(PHP_EOL, $input);
        $numberOfSeries = array_shift($lines);
        $series = [];

        for ($counter=0; $counter< $numberOfSeries; $counter++) {
            $series[$counter] = self::calculateSeriesSequence($lines[$counter]);
        }

        return $series;
    }

    private static function calculateSeriesSequence($series)
    {
        list($x, $y, $n) = explode(' ', $series);

        // first part of the series
        $currentSeries = array_fill(0, $x, $y);

        for ($cursor=0; $cursor  < ($n-$x); $cursor++) {
            $sum = 0;
            for ($z=0; $z<$x; $z++) {
                $sum += $currentSeries[$z+$cursor]; 
            }
            $currentSeries[$cursor+$x] = $sum;
        }

        return $currentSeries;
    }
}

class SeriesArrayToConsoleLine
{
    public static function output(array $series)
    {
        return implode(
            PHP_EOL,
            array_map(
                function($element)
                {
                    return implode(", ", $element); 
                },
                $series
            )
        );
    }
}
