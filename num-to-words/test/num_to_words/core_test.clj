(ns num-to-words.core-test
  (:require [midje.sweet :refer :all]
            [num-to-words.core :refer :all]))

(fact
    "about number-spelling"
    (spell-out 0) => "zero"
    (spell-out 1) => "one"
    (spell-out 9) => "nine"
    (spell-out 19) => "nineteen"
    (spell-out 20) => "twenty"
    (spell-out 21) => "twenty one"
    (spell-out 103) => "one hundred and three"
    (spell-out 999) => "nine hundred and ninety nine"
    (spell-out 1501) => "one thousand, five hundred and one"
    (spell-out 9000) => "nine thousand"
    (spell-out 9999) => "nine thousand, nine hundred and ninety nine"
    (spell-out 9999999) =>
    "nine million, nine hundred and ninety nine thousand, nine hundred and ninety nine"
    (spell-out 9999999999999) =>
    "nine thousand, nine hundred and ninety nine billion, nine hundred and ninety nine million, nine hundred and ninety nine thousand, nine hundred and ninety nine")
