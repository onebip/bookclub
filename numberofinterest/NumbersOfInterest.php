<?php

class NumbersOfInterest
{
    public static function calculate($input)
    {
        $lines = explode(PHP_EOL, $input);
        $numberOfSeries = array_shift($lines);
        $series = [];

        for ($counter=0; $counter< $numberOfSeries; $counter++) {
            list($x, $y, $n) = explode(' ', $lines[$counter]);

            // first part of the series
            $series[$counter] = array_fill(0, $x, $y);

            $secondSeries = [];
            for ($cursor=0; $cursor  < ($n-$x); $cursor++) {
                echo "C $cursor\n";
                $sum = 0;
                for ($z=$cursor; $z<$x; $z++) {
                   $sum += $series[$counter][$z]; 
                   echo "SUM $sum\n";
                }
                echo "Z $z\n";
                $series[$counter][$z] = $sum;
                print_r($series); 
            }

            //$series[$counter] = array_merge($firstSeries, $secondSeries);
            /*
            for ($j=$x; $j< $n; $j++) {
                array_shift($lines[$counter+1]);
                $output .=  array_slice($lines[$counter+1]);
            }
            */
        }

        print_r($series);
        $output = '';
        /*
        for ($counter=0; $counter<count($series); $counter++) {
            $output .= implode($series[$counter], ', ');
        }
*/

        return $output;
    }
}

class SecondSeriesPartCalculation
{
    public function __construct(array $secondSeries, $iterations, $x)
    {
        $this->process($secondSeries, $iterations, $x);
    }

    private function process($secondSeries, $iterations, $x)
    {
    }
}
