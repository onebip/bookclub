/*jshint asi: true, expr: true */

//
//var stringify = require('JSON2').stringify


var AlienInvasion = function () {

    function towns(stringa) {

        var towns = stringa.split(/\n/);

        // e.g. 'T north=N south=S'
        function builder(acc, rawTown) {
            var elems = rawTown.split(' ');

            acc[elems[0]] = planner(elems.slice(1));
            // give each town its due name
            acc[elems[0]].name = elems[0];
            //console.log(acc[elems[0]])
            return acc;
        }

        // e.g. ['north=N','south=S']
        function planner(rawRoads) {
            return rawRoads
            .reduce(paver, {});

            function paver(acc, rawRoad) {
                var elems = rawRoad.split('=');
                acc[elems[0]] = elems[1];
                return acc;
            }
        }

        var rawTowns = towns.reduce(builder, {});

        return Object.keys(rawTowns).reduce(function (townsAcc, townName) {

            var currentTown = townsAcc[townName];
            var directionsFromHere = Object.keys(currentTown).filter(_directionsFilter)
            // enrich destinations: objects instead of strings
            directionsFromHere.forEach(function(direction) {

                var destination = currentTown[direction];
                townsAcc[townName][direction] = function () {
                    return rawTowns[destination];
                };
            });
            return townsAcc;
        }, rawTowns);
    }

    function _directionsFilter(item) {
      var forbiddens = ['name','visitor'];
      return forbiddens.indexOf(item) === -1;
    }

    function landing(numAliens, towns){
      var aliens = {};
      var cc = 0;
      var townNames = Object.keys(towns);

      townNames.forEach(function(townName){
        towns[townName].visitor = new Function();
      });

      while (cc < numAliens) {
        if (cc === townNames.length) { break; }

        aliens['' + cc] = _alien(cc, aliens, towns);

        (function(pos) {
          towns[townNames[pos]].visitor = function() {
            return aliens['' + pos]
          };
        })(cc)

        cc++;
      }
      
      return {
        towns : towns,
        aliens : aliens
      }
    }

    function _alien(index, aliens, towns){
      var _name = '' + index;

      return { 
        name : '' + index, 
        move : _move
      };

      function _move(startTown){

        // e.g. ['north','east','south']
        var directions = Object.keys(startTown)
        .filter(_directionsFilter);
        
        if (directions.length > 0) {

          var chosenIndex = ~~(Math.random() * directions.length)
          var endTown = startTown[directions[chosenIndex]]();

          // get away from current town
          startTown.visitor = function() {
            return undefined;
          }
          // check possible next town visitor
          if (!endTown.visitor()) {
            // move to the next town
            endTown.visitor = function() {
              return aliens[_name]; 
            }
          } else {
          // kill the bastard
          delete aliens[endTown.visitor().name]; 
          // destroy everything
          delete towns[endTown.name];
          // fall dead
          delete aliens[_name];
          }
        }
      }
    }

    function game(rawWorld,numAliens) {

      function Wrapper(state) {
        this.currentTurn = 0;
        this.towns = state.towns;
        this.aliens = state.aliens;
      }

      Wrapper.prototype.run = function(turns) {
        this.currentTurn = turns;

        setTimeout(_runner(this),1);

        return this;
      };

      Wrapper.prototype.running = function() {
        return this.currentTurn > 0 && Object.keys(this.aliens).length > 0;
      };

      function _runner(game) {
        //while (game.running()) {
        var aliens = game.aliens;

        if (Object.keys(aliens).length > 0) {

          aliens['0'].move({})
        }
        //}
      }

      return new Wrapper(landing(numAliens,towns(rawWorld)))
    }

    return {
        towns : towns,
        game : game,
        landing : landing
    }
}
()
























if (typeof module === 'object' && typeof module.exports !== 'undefined') {
    module.exports = {
        AI : AlienInvasion
    }
}
