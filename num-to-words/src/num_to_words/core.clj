(ns num-to-words.core
  (:gen-class))


(def base {0 "zero"
           1 "one"
           2 "two"
           3 "three"
           4 "four"
           5 "five"
           6 "six"
           7 "seven"
           8 "eight"
           9 "nine"})

(def exceptions (merge base {10 "ten" 
                             11 "eleven"
                             12 "twelve"
                             13 "thirteen"
                             15 "fifteen"
                             18 "eighteen"
                             20 "twenty"
                             30 "thirty"
                             40 "fourty"
                             50 "fifty"
                             60 "sixty"
                             70 "seventy"
                             80 "eighty"
                             90 "ninety"}))

(def big-numbers [1000000 1000 100])

(def position {100 "hundred"
               1000 "thousand"
               1000000 "million"})

(defn find-position [number]
  (loop [queue big-numbers]
    (let [big-number (first queue)]
      (if (> (quot number big-number) 0)
        big-number
        (recur (rest queue))))))

(defn smart-compose [number]
  (if (= (mod number 10) 0)
    (exceptions (* (quot number 10) 10))
    (str
      (exceptions (* (quot number 10) 10))
      "-" 
      (base (mod number 10)))))

(defn compose [number]
  (let [pos (find-position number)]
  (str
    (base (quot number pos))
    " "
    (position pos))))

(defn teen-compose [number]
  (if (contains? exceptions number)
    (exceptions number)
    (str (base (mod number 10)) "teen")))

(defn spell-out [number]
  (cond 
    (< number 10) 
      (base number)
    (< number 20) 
      (teen-compose number)
    (< number 100) 
      (smart-compose number)
    :else
      (compose number)))

