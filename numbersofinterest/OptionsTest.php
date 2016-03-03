<?php
namespace NumbersOfInterest;
require_once __DIR__ . '/Options.php';
use NumbersOfInterest\Options;

class OptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testWhenTheNumberOfSeriesIsZeroAnExceptionIsRaised()
    {
        $numberOfSeries = 0;
        $input = <<<EOT
$numberOfSeries
3 2 7
EOT;
        new Options($input);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWhenTheNumberOfSeriesIsNegativeAnExceptionIsRaised()
    {
        $numberOfSeries = -1;
        $input = <<<EOT
$numberOfSeries
3 2 7
EOT;
        new Options($input);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWhenOptionsAreInvalidAnExceptionIsRaised()
    {
        new Options('');
    }

    public function testWhenOptionsAreValidTheStructureIsSavedProperly()
    {
        $numberOfSeries = 2;
        $input = <<<EOT
$numberOfSeries
3 2 7
4 9 10
EOT;
        $options = new Options($input);
        $this->assertEquals(
            [[3,2,7],[4,9,10]],
            $options->toArray() 
        );
    }
}
