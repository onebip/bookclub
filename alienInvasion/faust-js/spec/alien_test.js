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

describe('AlienInvasion', function(){


  it('should be possible to destroy towns and leave destinations undefined', function(){

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

  it('should create two towns from a formatted string', function(){

    var stringa = 'S north=N\nN south=S';

    var towns = ai.towns(stringa);
    var townNames = Object.keys(towns)

    //expect(stringify(townNames)).to.be.equal('')
    //expect(stringify(towns)).to.be.equal('')
    expect(townNames.length).to.be.equal(2)
    expect(Object.keys(towns['S']).length).to.be.equal(1)
  
    expect(towns['S']['north']()).to.be.equal(towns['N'])
  })

  it('should read and compile a large file',function(){

    var largeWorld = fs.readFileSync(__dirname + '/../docs/world_map_large.txt','utf8')
    var towns = ai.towns(largeWorld)
    var townNames = Object.keys(towns)

   // expect(townNames.length).to.be.equal(6764)

    expect(towns[townNames[2747]]['west']()).to.be.equal(towns[townNames[4331]])
    expect(towns[townNames[428]]['north']()).to.be.equal(towns[townNames[676]])
    expect(towns[townNames[4034]]['south']()).to.be.equal(towns[townNames[4278]])
    expect(towns[townNames[6761]]['east']()).to.be.equal(towns[townNames[2486]])
    expect(towns[townNames[1743]]['south']()).to.be.equal(towns[townNames[1987]])
  })

  it('should allow town destructions', function(){

    var stringa = 'NW east=NE south=SW\nNE west=NW south=SE\nSE north=NE west=SW\nSW east=SE north=NW';
    var towns = ai.towns(stringa);

    var roadsFromNW = towns['NW']
    expect(Object.keys(roadsFromNW).length).to.be.equal(2)
    expect(roadsFromNW['south']()).to.be.equal(towns['SW'])

    delete towns['SW']
    expect(Object.keys(towns).length).to.be.equal(3)
    expect(roadsFromNW['south']()).to.be.undefined

  })

})
