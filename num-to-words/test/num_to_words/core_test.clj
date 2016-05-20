(ns num-to-words.core-test
  (:require [midje.sweet :refer :all]
            [num-to-words.core :refer :all]))

(facts
  (fact "single digit"
    "about number-spelling"
    (spell-out 0) => "zero"
    (spell-out 1) => "one"
    (spell-out 9) => "nine")

  (fact "two digits"
    (spell-out 10) => "ten"
    (spell-out 11) => "eleven"
    (spell-out 12) => "twelve"
    (spell-out 13) => "thirteen"
    (spell-out 14) => "fourteen"
    (spell-out 15) => "fifteen"
    (spell-out 16) => "sixteen"
    (spell-out 17) => "seventeen"
    (spell-out 18) => "eighteen"
    (spell-out 19) => "nineteen"
    (spell-out 20) => "twenty"
    (spell-out 21) => "twenty-one"
    (spell-out 24) => "twenty-four"
    (spell-out 37) => "thirty-seven"
    (spell-out 40) => "fourty"
    (spell-out 54) => "fifty-four"
    (spell-out 68) => "sixty-eight"
    (spell-out 99) => "ninety-nine"
    (spell-out 100) => "one hundred"
;    (spell-out 103) => "one hundred and three"
;    (spell-out 999) => "nine hundred and ninety-nine"
;    (spell-out 1501) => "one thousand, five hundred and one"
    (spell-out 9000) => "nine thousand")
;    (spell-out 9999) => "nine thousand, nine hundred and ninetyi-nine"
;    (spell-out 9999999) =>
;    "nine million, nine hundred and ninety nine thousand, nine hundred and ninety-nine"
;    (spell-out 9999999999999) =>
;    "nine thousand, nine hundred and ninety nine billion, nine hundred and ninety-nine million, nine hundred and ninety nine thousand, nine hundred and ninety nine")
)
