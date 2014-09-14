/*jshint asi: true, expr: true */

require(__dirname + "/helper")

var assert = require("assert")
var sinon = require("sinon")
var chai = require("chai")
var expect = chai.expect
chai.use(require("sinon-chai"))

//var Countdowner = require(__dirname + "/../../public/js/versionB/widgets").Countdowner

describe("AlienInvasion",function(){


  // TODO - make this matter testable
  it.skip("should create the right markup at init", function(){
  
    var cd = new Countdowner();
    var $parent = $('<div/>');
    cd.init($parent);

    var $cdSpan = $('#countdown-time_'+cd._id,$parent);
    expect($cdSpan.length).to.be.equal(1)
    expect($cdSpan.text()).to.be.equal(cd.startValue)
    
  })


})
