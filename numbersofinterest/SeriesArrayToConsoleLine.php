<?php
namespace NumbersOfInterest;

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
