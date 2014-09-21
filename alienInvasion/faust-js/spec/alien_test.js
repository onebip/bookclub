/*jshint asi: true, expr: true */

require(__dirname + '/helper')

var assert = require('assert')
var sinon = require('sinon')
var chai = require('chai')
var expect = chai.expect
chai.use(require('sinon-chai'))
var JSON2 = require('JSON2')
var stringify = JSON2.stringify
var fs = require('fs')

var code = require('../code/alienInvasion')
var ai = code.AI

describe('During an Alien Invasion', function(){

  describe('as a spike to explore implementation mechanics ',function(){
    it('we remove object props and leave pointers undefined by using getters instead of straight references', function(){

      function fab() {return towns['bbb']}
      function fba() {return towns['aaa']}
      var towns = {
        aaa : {south:fab},
        bbb : {north:fba}
      }

      expect(towns['bbb']['north']()).to.be.equal(towns['aaa'])

      delete towns['aaa']
      expect(towns['bbb']['north']()).to.be.undefined
    })
    it('generates random indexes to test arrays\' ranges',function(){

      var test1 = [0,1,2,3,4,5,6,7,8];
      runn();
      var test1 = [0,1];
      runn();
      var test1 = [0];
      runn();

      function runn() {
        for (cc = 0; cc < 1000; cc++) {
          var ttt = ~~(Math.random() * test1.length);
          expect(ttt).to.be.at.least(0)
          expect(ttt).to.be.at.most(test1.length-1)
        }
      }
    })
  })

  describe('during world creation it', function(){ 
    it('is possible to create two towns from a formatted string', function(){

      var stringa = 'S north=N\nN south=S';

      var towns = ai.towns(stringa);
      var townNames = Object.keys(towns)

      expect(townNames.length).to.be.equal(2)
      expect(Object.keys(towns['S']).length).to.be.equal(2) // count 'name' as well

      expect(towns['S']['north']()).to.be.equal(towns['N'])
    })

    it('should be possible to have a 1-town world',function(){
      var oneTown = ai.towns('XXX')
      expect(Object.keys(oneTown).length).to.be.equal(1)
      expect(oneTown['XXX']).to.be.not.undefined
      expect(Object.keys(oneTown['XXX']).length).to.be.equal(1)
    })

    it('is possible to read and compile a large file',function(){

      var largeWorld = fs.readFileSync(__dirname + '/../docs/world_map_large.txt','utf8')
      var towns = ai.towns(largeWorld)
      var townNames = Object.keys(towns)

      expect(townNames.length).to.be.equal(6764)

      expect(towns[townNames[2747]]['west']()).to.be.equal(towns[townNames[4331]])
      expect(towns[townNames[428]]['north']()).to.be.equal(towns[townNames[676]])
      expect(towns[townNames[4034]]['south']()).to.be.equal(towns[townNames[4278]])
      expect(towns[townNames[6761]]['east']()).to.be.equal(towns[townNames[2486]])
      expect(towns[townNames[1743]]['south']()).to.be.equal(towns[townNames[1987]])
    })

    it('is possible to destroy the towns just created', function(){

      var stringa = 'NW east=NE south=SW\nNE west=NW south=SE\nSE north=NE west=SW\nSW east=SE north=NW';
      var towns = ai.towns(stringa);

      var roadsFromNW = towns['NW']
      expect(Object.keys(roadsFromNW).length).to.be.equal(3) // count 'name' as well
      expect(roadsFromNW['south']()).to.be.equal(towns['SW'])

      delete towns['SW']
      expect(Object.keys(towns).length).to.be.equal(3)
      expect(roadsFromNW['south']()).to.be.undefined

    })
  })

  describe('during the initial landing it',function(){
    it('is possible to land one alien in a one-town world',function(){

      var towns = ai.towns('Capitol')
      var worldState = ai.landing(1,towns)

      expect(Object.keys(worldState.aliens).length).to.be.equal(1)
      expect(worldState.towns).to.be.equal(towns)
      expect(towns['Capitol'].visitor()).to.be.equal(worldState.aliens['0'])
      expect(towns['Capitol'].visitor().name).to.be.equal('0')

      expect(Object.keys(worldState.aliens)).to.have.members(['0'])
    })

    it('is possible to land two aliens in a two-town world',function(){

      var stringa = 'S north=N\nN south=S';
      var towns = ai.towns(stringa)
      var worldState = ai.landing(2,towns)

      var alienNames = Object.keys(worldState.aliens);
      expect(alienNames.length).to.be.equal(2)
      expect(towns['S'].visitor().name).to.satisfy(function(alienName){
        return alienNames.indexOf(alienName) !== -1
      }) 
      expect(towns['N'].visitor().name).to.satisfy(function(alienName){
        return alienNames.indexOf(alienName) !== -1
      }) 
    })

    it('is possible to land N aliens in a 2*N-towns world',function(){

      var stringa = 'NW east=NE south=SW\nNE west=NW south=SE\nSE north=NE west=SW\nSW east=SE north=NW';
      var towns = ai.towns(stringa);
      var worldState = ai.landing(2,towns)

      var alienNames = Object.keys(worldState.aliens);
      expect(alienNames.length).to.be.equal(2)

      Object.keys(towns).forEach(function(townName){
        if (towns[townName].visitor()) {
          expect(towns[townName].visitor().name).to.satisfy(function(alienName){
            return alienNames.indexOf(alienName) !== -1
          }) 
        }
      });
      expect(Object.keys(worldState.aliens)).to.have.members(['0','1'])
    })

    it('is NOT possible to overcrowd a world',function(){
      var towns = ai.towns('Capitol')
      var worldState = ai.landing(20,towns)
      expect(Object.keys(worldState.aliens).length).to.be.equal(1)
      expect(towns['Capitol'].visitor()).to.be.equal(worldState.aliens['0'])
    })
  })

  describe('the game',function(){

    it('starts by creating a N-towns world from a string',function(){
      expect(ai.game).to.exist
      expect(ai.game('Capitol').towns['Capitol']).to.exist
      expect(ai.game('CapitolXXX').towns['Capitol']).to.not.exist
      expect(Object.keys(ai.game('XXX').towns).length).to.be.equal(1)
    }) 

    it('starts by landing X aliens', function(){
      
      var stringa = 'NW east=NE south=SW\nNE west=NW south=SE\nSE north=NE west=SW\nSW east=SE north=NW';
      var game = ai.game(stringa,3);
      expect(Object.keys(game.towns).length).to.be.equal(4)
      expect(Object.keys(game.aliens).length).to.be.equal(3)

      var towns = game.towns
      var alienNames = Object.keys(game.aliens)
      Object.keys(towns).forEach(function(townName){
        if (towns[townName].visitor()) {
          expect(towns[townName].visitor().name).to.satisfy(function(alienName){
            return alienNames.indexOf(alienName) !== -1
          }) 
        }
      });
      expect(alienNames).to.have.members(['0','1','2'])
    }) 

    describe('when realistic',function(){
      beforeEach(function() {
        var stringa = 'NW east=NE south=SW\nNE west=NW south=SE\nSE north=NE west=SW\nSW east=SE north=NW';
        this.game = ai.game(stringa,2);
      })

      it('starts by recording the number of game turns',function(){
        this.game.run(10);
        expect(this.game.running()).to.be.true
      }) 

      it('sends individual aliens asynch messages with order to move',function(done){
        var alien0 = this.game.aliens['0'];
        alien0.move = sinon.spy();
        this.game.run(10);

        setTimeout(function(){
          expect(alien0.move).to.have.been.called;
          done();
        },50)
      })

      it('ends when turns are over') 
      it('ends when all aliens are dead') 
      it('ends by telling how many aliens and towns are left on the planet')
    })
  })
  
  describe('an alien',function(){

    describe('in a single-alien simulation',function(){
      beforeEach(function() {
        var stringa = 'N south=S\nS north=N';
        this.game = ai.game(stringa,1);
      })

      it.skip('reacts to a request to move',function(){
        var game = this.game;
        expect(game.towns['N'].visitor()).to.exist
        expect(game.towns['S'].visitor()).to.not.exist

        // TODO - possibly needed by the game controller

      }) 

      it('finds his way from a given town',function(){
        var game = this.game;
        var townN = game.towns['N']
        var alien0 = game.aliens['0']
        alien0.move(townN)
        expect(game.towns['S'].visitor()).to.be.equal(alien0)
        expect(game.towns['N'].visitor()).to.not.exist
      }) 
    })

    describe('in a dual-alien simulation',function(){
      beforeEach(function() {
        var stringa = 'N south=S\nS north=N';
        this.game = ai.game(stringa,2);
      })

      it('detects other aliens in a town',function(){
        var game = this.game;
        var townN = game.towns['N'];
        var alien0 = game.aliens['0'];
        expect(game.towns['S'].visitor()).to.be.equal(game.aliens['1']);
        game.towns['S'].visitor = sinon.spy(game.towns['S'],'visitor');
        alien0.move(townN);
        // S town has been destroyed along with the spy
        //expect(game.towns['S'].visitor).to.have.been.called;
      })

      describe('after seeing a rival at the horizon',function(){
        beforeEach(function() {
          this.townN = this.game.towns['N'];
          this.alien0 = this.game.aliens['0'];
        })

        it('can kill a town\'s visitor',function(){
          expect(this.game.aliens['1']).to.exist;
          this.alien0.move(this.townN);
          expect(this.game.aliens['1']).to.not.exist;
        })

        it('can destroy a town',function(){
          this.alien0.move(this.townN);
          expect(this.game.towns['S']).to.not.exist;
        })

        it('always dies hard',function(){
          this.alien0.move(this.townN);
          expect(this.game.aliens['0']).to.not.exist;
        })
      })
    }) 
  })
})
