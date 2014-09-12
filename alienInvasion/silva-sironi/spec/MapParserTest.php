<?php

class AcceptanceTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->events = [];
        $this->eventStore = function ($event) {
            $this->events[] = $event;
        };
    }

    public function testAnAlienStartingOutLandsOnACity()
    {
        $alien = 'A1';

        $this->givenTheMap(self::SINGLE_CITY_MAP);
        $this->map->startOut($alien);
        $this->assertEquals('Alien A1 is landed on E', $this->events[0]);
    }

    public function testAnAlienStartsOutOnAMapOfTwoCitiesOnTheOneHeWants()
    {
        $this->givenTheMap(self::TWO_CITIES_MAP);

        $this->map->startOut('A1', 0);
        $this->assertEquals('Alien A1 is landed on E', $this->events[0]);

        $this->map->startOut('A2', 1);
        // TODO: get last event
        $this->assertEquals('Alien A2 is landed on F', $this->events[1]);
    }

    public function testAnAlienCanMoveAroundTheCities()
    {
        $alien = 'A1';
        $this->givenTheMap(self::TWO_CITIES_MAP);
        $this->givenAnAlienOnCity($alien, 0);

        $this->map->move($alien, Map::FIRST_DIRECTION);

        $this->assertEquals('Alien A1 is moved on F', $this->events[1]);
    }


    private function givenTheMap($mapRepresentationAsAString)
    {
        $this->map = Map::fromString($mapRepresentationAsAString);
        $this->map->setEventStore($this->eventStore);
    }

    private function givenAnAlienOnCity($alien, $city)
    {
        $this->map->startOut($alien, 0);
    }

    const SINGLE_CITY_MAP = 'E';
    const TWO_CITIES_MAP = "E north=F\nF south=E";
}

class MapTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->events = [];
        $this->eventStore = function ($event) {
            $this->events[] = $event;
        };
    }

    public function testAMapOfTwoCitiesCanBeBuiltFromAString()
    {
        $this->assertEquals(
            new Map([
                [
                    'name' => 'E',
                    'neighbors' => ['F'],
                ],
                [
                    'name' => 'F',
                    'neighbors' => ['E'],
                ],
            ]),
            Map::fromString("E north=F\nF south=E")
        );
    }

    public function testMoveInAnyDirectionsEmitsAnAlienMovedEventWithRightDestinationCity()
    {
        $alien = 'A1';
        $this->map = Map::fromString("E north=F\nF south=E");
        $this->map->setEventStore($this->eventStore);

        $this->map->startOut($alien, 0);
        $this->events = [];
        $this->map->move($alien, Map::FIRST_DIRECTION);

        $this->assertEquals('Alien A1 is moved on F', $this->events[0]);


        $this->map->startOut($alien, 1);
        $this->events = [];
        $this->map->move($alien, Map::FIRST_DIRECTION);

        $this->assertEquals('Alien A1 is moved on E', $this->events[0]);
    }
}

class Map
{
    const FIRST_DIRECTION = 0;

    private $cities;
    private $eventStore;

    public function __construct($cities)
    {
        $this->cities = $cities;
        $this->eventStore = function() {};
    }

    public function setEventStore(callable $eventStore)
    {
        $this->eventStore = $eventStore;
    }

    public static function fromString($data)
    {
        return new self(self::parse($data));
    }

    public function startOut($alien, $cityIndex = 0)
    {
        $this->aliens[$alien] = $cityIndex;
        call_user_func($this->eventStore, "Alien $alien is landed on {$this->cities[$cityIndex]['name']}");
    }

    public function move($alien, $direction)
    {
        $nextCity = $this->findCity($this->aliens[$alien], $direction);
        call_user_func($this->eventStore, "Alien $alien is moved on {$nextCity}");
    }

    private function findCity($cityIndex, $direction)
    {
        return $this->cities[$cityIndex]['neighbors'][$direction];
    }

    private static function parse($data)
    {
        $lines = explode("\n", $data);
        return array_map(
            function($line) {
                $lineItems = explode(" ", $line);
                $cityName = array_shift($lineItems);
                $neighbors = [];
                foreach ($lineItems as $directionCityPair) {
                    list (, $neighborName) = explode("=", $directionCityPair);
                    $neighbors[] = $neighborName;
                }
                return ['name' => $cityName, 'neighbors' => $neighbors];
            },
            $lines
        );
    }
}
