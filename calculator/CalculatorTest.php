<?php
class Calculator
{
    public function add($numbers)
    {
        $papperino = preg_split("#(\n|,)#", $numbers);
        $pippo = array_map(
                'intval',
                $papperino
            );
        return array_sum($pippo);
    }
}
class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->calculator = new Calculator();
    }

    public function testGivenEmptyStringItReturns0()
    {
        $this->assertEquals(0, $this->calculator->add(''));
    }

    public function testGivenOneNumberItReturnsThatNumber()
    {
        $this->assertEquals(42, $this->calculator->add('42'));
    }

    public function testGivenTwoNumbersItReturnsItsSum()
    {
        $this->assertEquals(100, $this->calculator->add('42,58'));
    }

    public function testAllowTheAddMethodToHandleNewLineNumbers()
    {
        $this->assertEquals(6, $this->calculator->add("1\n2,3"));
    }
}
