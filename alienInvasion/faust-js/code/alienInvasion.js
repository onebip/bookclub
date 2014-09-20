/*jshint asi: true, expr: true */

//
//var stringify = require('JSON2').stringify


var AlienInvasion = function(){

  function towns(stringa){

    var towns = stringa.split(/\n/)

    // e.g. 'T north=N south=S'
    function builder(acc, rawTown) {
      var elems = rawTown.split(' ')

      acc[elems[0]] = planner(elems.slice(1)) 
      return acc
    }

    // e.g. ['north=N','south=S']
    function planner(rawRoads) {
      return rawRoads
      .reduce(paver,{})

      function paver(acc, rawRoad) {
        var elems = rawRoad.split('=')
        acc[elems[0]] = elems[1]
        return acc
      }
    }

    var rawTowns = towns.reduce(builder, {})

    return Object.keys(rawTowns).reduce(function(townsAcc, townName) {

      var roadsFromHere = townsAcc[townName] 
      if (roadsFromHere) {
        var directions = Object.keys(roadsFromHere)

        var pippo = {}

        directions.forEach(function(dir){

          var destination = roadsFromHere[dir]
          
          pippo[dir] = function(){

            return rawTowns[destination]
          }
        
        })
        townsAcc[townName] = pippo

      } 
      return townsAcc
    }, rawTowns)
  }

  return {
    towns : towns 
  }
}()

if (typeof module === 'object' && typeof module.exports !== 'undefined') {
  module.exports = {
    AI: AlienInvasion
  }
}


