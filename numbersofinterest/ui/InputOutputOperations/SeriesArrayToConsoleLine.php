<?php
namespace UI;

class SeriesArrayToConsoleLine
{
    public function output(array $series)
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
