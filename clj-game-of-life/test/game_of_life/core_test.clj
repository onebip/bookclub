(ns game-of-life.core-test
  (:use midje.sweet)
  (:require [game-of-life.core :as gol]))

(facts "about alive cells"
  (fact "with fewer than 2 alive neighbours die"
    (gol/next-state :alive 0) => :dead
    (gol/next-state :alive 1) => :dead)

  (fact "with 2 or 3 alive neighbours stay alive"
    (gol/next-state :alive 2) => :alive
    (gol/next-state :alive 3) => :alive)

  (fact "with more than 3 neighbours die"
    (gol/next-state :alive 4) => :dead
    (gol/next-state :alive 5) => :dead
    (gol/next-state :alive 6) => :dead
    (gol/next-state :alive 7) => :dead
    (gol/next-state :alive 8) => :dead))

(facts "about dead cells"
  (fact "with 3 alive neighbours become alive"
    (gol/next-state :dead 3) => :alive)

  (fact "with neighbours count different than 3 stay dead"
    (gol/next-state :dead 0) => :dead
    (gol/next-state :dead 1) => :dead
    (gol/next-state :dead 2) => :dead
    (gol/next-state :dead 4) => :dead
    (gol/next-state :dead 5) => :dead
    (gol/next-state :dead 6) => :dead
    (gol/next-state :dead 7) => :dead
    (gol/next-state :dead 8) => :dead))

(facts "about candidates"
  (let [cell [-1 0]
        candidates (gol/candidates cell)]
    (count candidates) => 9
    (set? candidates) => true
    (every? (fn [[x y]]
              (and (<= -2 x 0)
                   (<= -1 y 1)))
            candidates) => true))

(facts "world examples"
  (fact "blinker"
    (let [step-1 #{[-1 0] [0 0] [1 0]}
          step-2 #{[0 -1] [0 0] [0 1]}]
      (gol/tick step-1) => step-2
      (gol/tick step-2) => step-1)))
