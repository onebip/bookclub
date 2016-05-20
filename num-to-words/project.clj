(defproject num-to-words "0.1.0-SNAPSHOT"
  :description "FIXME: write description"
  :url "http://example.com/FIXME"
  :license {:name "Eclipse Public License"
            :url "http://www.eclipse.org/legal/epl-v10.html"}
  :dependencies [[org.clojure/clojure "1.8.0"]]
  :main ^:skip-aot num-to-words.core
  :target-path "target/%s"
  :profiles {:dev {:plugins [[lein-midje "3.2"]]
                   :dependencies [[midje "1.8.3"]]}
             :midje {}})
