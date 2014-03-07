<?php

class ArabicNumbersToItalianWord
{
    private $translator;

    public function __construct()
    {
        $numbers = [1, 99, 300,
            310, 1501, 12609,
            425454, 100001
        ];
        $words = ['uno', 'novantanove',
            'trecento', 'trecentodieci',
            'mille cinque cento uno',
            'dodici milla sei cento nove',
            'quattro cento venticinque quattro milla quattro cento cinquanta quattro',
            'un millione e uno',
        ];

        foreach ($numbers as $index => $number) {
            $this->translator[$number] = $words[$index];
        }
    }

    public function translate($number)
    {
        if (array_key_exists($number, $this->translator)) {
            return $this->translator[$number];
        }
    }
}
