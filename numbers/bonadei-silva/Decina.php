<?php

class Decina extends Numero
{
    private $unita;

    public function __construct()
    {
        $this->unita = new Unita(0);
    }

    protected $stele = [
        '2' => 'venti',
    ];

    public function aggiungi(Unita $unita)
    {
        $this->unita = $unita;
    }

    public function __toString()
    {
        $string = $this->traduci($this->numero);

        $unitaInParole = $this->unita->__toString();
        if ($this->iniziaConVocale($unitaInParole)) {
            return substr($string, 0, -1) . $unitaInParole;
        } else {
            return $string . $unitaInParole;
        }
    }
}
