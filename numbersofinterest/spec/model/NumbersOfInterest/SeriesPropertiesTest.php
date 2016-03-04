<?php
namespace NumbersOfInterest;

require_once __DIR__ . '/../../../model/NumbersOfInterest/SeriesProperties.php';

class SeriesPropertiesTest extends \PHPUnit_Framework_TestCase
{
    public function testWithAGoodInputIRetrieveAGoodSeriesProperties()
    {
        $series = new SeriesProperties('A;B;C', ';');

        $this->assertEquals(
            'totalOfNumbers:C, referenceNumber:B, occurencesOfReferenceNumber:A',
            (string)$series
        );
    }

    public function testWithAGoodInputIRetrieveGoodSeriesPropertiesAttributes()
    {
        $series = new SeriesProperties('A;B;C', ';');

        $this->assertEquals(
            'C',
            $series->totalOfNumbers
        );
        $this->assertEquals(
            'B',
            $series->referenceNumber
        );
        $this->assertEquals(
            'A',
            $series->occurencesOfReferenceNumber
        );
    }

    public function testWithFromAnInputArrayIRetrieveGoodSeriesPropertiesAttributes()
    {
        $series = SeriesProperties::fromArray(['A', 'B', 'C']);

        $this->assertEquals(
            'C',
            $series->totalOfNumbers
        );
        $this->assertEquals(
            'B',
            $series->referenceNumber
        );
        $this->assertEquals(
            'A',
            $series->occurencesOfReferenceNumber
        );
    }
    /**
     * @expectedException InvalidArgumentException
     */
    public function testWhenSeriesPropertiesIsNotValidAnExceptionIsThrown()
    {
        new SeriesProperties('');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWhenSeriesPropertiesIsNotParsableWithSeparatorAnExceptionIsThrown()
    {
        $separator = '#';
        new SeriesProperties('A;B;C', $separator);
    }
}
