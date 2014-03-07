<?php

class Convertitore
{
    private $tensToLetters = [
            2 => 'venti'
        ];

    private $unitsToLetters = [
            1 => 'uno',
            2 => 'due',
            3 => 'tre',
        ];

    public function __invoke($numero)
    {
        if (isset($this->unitsToLetters[$numero])) {
            return $this->unitsToLetters[$numero];
        }

        $numeroObject = new Numero($numero); 

        $units = $numeroObject->units();
        $tens = $numeroObject->tens();
        return $this->tensToLetters[$tens] . $this->unitsToLetters[$units];
    }
}


class Numero
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
        $this->toString = (string) $this->value;
    }

    public function units()
    {
        return $this->value % 10;
        $lastCharacter = strlen($this->toString) - 1;
        return $this->toString[$lastCharacter];
    }

    public function tens()
    {
        $secondLastCharacter = strlen($this->toString) - 2;
        return (int) $this->toString[$secondLastCharacter];
    }
}
