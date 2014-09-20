/*jshint asi: true, expr: true */

var fs = require("fs")


var AlienInvasion = function(){

  function towns(stringa){

    var towns = stringa.split(/\n/)

    // e.g. 'T north=N south=S'
    function builder(stringa) {
      var elems = stringa.split(' ')

      return {
        name : elems[0],
        roads : paver(elems.slice(1))
      }
    }

    // e.g. ['north=N','south=S']
    function paver(rawRoads) {
      return rawRoads
      .map(function(rawRoad) {
        return rawRoad.split('=')
      })
      .map(function(roadPieces) {
        return {
          direction : roadPieces[0],
          destination : roadPieces[1]
        }
      })
    }

    return towns.map(function(rawTown) {
      return builder(rawTown)
    })
  }

  return {
    towns: towns

  }
}()


  function foldl(list,fun,acc) {
    if (list.length === 0) return acc
    var x = list.shift()
    return foldl(list, fun, fun(acc, x))
  }

if (typeof module === "object" && typeof module.exports !== "undefined") {
  module.exports = {
    AI: AlienInvasion,
    foldl: foldl
  }
}


