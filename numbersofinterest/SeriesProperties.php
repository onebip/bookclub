<?php
namespace NumbersOfInterest;

final class SeriesProperties
{
    private $totalOfNumbers=null;
    private $referenceNumber=null;
    private $occurencesOfReferenceNumber=null; 

    public function __construct($properties, $separator=' ')
    {
        try {
            list(
                $this->occurencesOfReferenceNumber,
                $this->referenceNumber, 
                $this->totalOfNumbers
            ) = explode($separator, $properties);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException(
                'Input given for series "' . var_export($properties, true) . '" and separator "' . $separator . '" is invalid'
            );
        }
    }

    public static function fromArray(array $properties)
    {
        return new self(implode(' ', $properties));
    }

    public function __toString()
    {
        return 'totalOfNumbers:' . $this->totalOfNumbers
            . ', referenceNumber:' . $this->referenceNumber 
            . ', occurencesOfReferenceNumber:' . $this->occurencesOfReferenceNumber;
    }

    public function __get($attributeName)
    {
        return $this->{$attributeName};
    }
}
