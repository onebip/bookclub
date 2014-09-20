/*jshint asi: true, expr: true */

require(__dirname + "/helper")

var assert = require("assert")
var sinon = require("sinon")
var chai = require("chai")
var expect = chai.expect
chai.use(require("sinon-chai"))

var code = require("../code/alienInvasion")
var ai = code.AI
var foldl = code.foldl

describe("AlienInvasion", function(){


  it("should create two towns from a formatted string", function(){

    var stringa = 'T north=N south=S\nW north=NN south=SS';

    var towns = ai.towns(stringa);

    expect(towns.length).to.be.equal(2)

    var townT = towns[0]
    expect(townT.name).to.be.equal('T')
    expect(townT.roads.length).to.be.equal(2)
    //expect(townT.roads['north']).to.be.equal('N')

  })


  it('foldl',function(){
    expect(foldl([1,2,3,4],function(acc,x){return x+acc},0)).to.be.equal(10)
  })

})
