<?php
namespace UI;

class Options 
{
    private $numberOfSeries=null;
    private $seriesOptions=null;

    public function __construct($input)
    {
        $raws = explode(PHP_EOL, $input);
        $this->numberOfseries = array_shift($raws);

        if ($this->numberOfseries < 1) {
            throw new \InvalidArgumentException(
                'Number of series to be performed "' . $this->numberOfSeries . '" not valid (>=1)'
            );
        }
        $this->seriesOptions = $raws; 
    }

    public function all()
    {
        $seriesOptionsArray = [];
        foreach ($this->seriesOptions as $serieOption) {
            $seriesOptionsArray[] = explode(' ', $serieOption);
        }

        return $seriesOptionsArray;
    }
}
