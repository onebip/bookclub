<?php

class Numero
{
    protected $numero;
    protected $stele = [
        10 => "dieci",
        11 => "undici",
        12 => "dodici",
        13 => "tredici",
        14 => "quattordici",
        15 => "quindici",
        16 => "sedici",
        17 => "diciassette",
        18 => "diciotto",
        19 => "diciannove",
    ];

    public function __construct($numero)
    {
        $this->numero = $numero;
    }

    public function daCifra($cifra)
    {
        if ($cifra < 10) {
            return new Unita($cifra);
        } else {
            return new self($cifra);
        }
    }

    public function __toString()
    {
        return $this->traduci($this->numero);
    }

    protected function traduci($numero)
    {
        if (array_key_exists($numero, $this->stele)) {
            return $this->stele[$numero];
        } else {
            $decina = new Decina((int)floor($numero / 10));
            $decina->aggiungi(new Unita($numero % 10));
            return (string) $decina;
        }
    }

    public function iniziaConVocale($string)
    {
        $primaLettera = substr($string, 0, 1);
        return in_array($primaLettera, ['a','e','i','o','u']);
    }
}
