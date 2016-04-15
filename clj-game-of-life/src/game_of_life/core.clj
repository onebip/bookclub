(ns game-of-life.core
  (:require [clojure.set :as set]))

(defn next-state
  [current-state neighbours-count]
  (condp = current-state
    :alive
      (if (<= 2 neighbours-count 3)
        :alive
        :dead)
    :dead
      (if (= 3 neighbours-count)
        :alive
        :dead)))

(defn neighbours [[x y]]
  #{[(dec x) (dec y)] [(dec x) y] [(dec x) (inc y)]
    [x       (dec y)]             [x       (inc y)]
    [(inc x) (dec y)] [(inc x) y] [(inc x) (inc y)]})

(defn candidates [[x y]]
  (conj (neighbours [x y])
        [x y]))

(defn state [cell world]
  (if (world cell)
    :alive
    :dead))

(defn count-alive-neighbours [cell world]
  (->> (neighbours cell)
       (filter world)
       count))

(defn will-be-alive? [world cell]
  (let [current-state (state cell world)]
    (->> (count-alive-neighbours cell world)
         (next-state current-state)
         (= :alive))))

(defn tick [world]
  (->> (map candidates world)
       (reduce set/union)
       (filter (partial will-be-alive? world))
       set))
