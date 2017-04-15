<?php

namespace TripSorter\Test\BoardingCard;

use PHPUnit\Framework\TestCase;
use TripSorter\BoardingCard\AirplaneCard;
use TripSorter\BoardingCard\BoardingCard;
use TripSorter\BoardingCard\BoardingCards;
use TripSorter\BoardingCard\BusCard;
use TripSorter\BoardingCard\TrainCard;

class BoardingCardsTest extends TestCase {

    public function provideJson() {
        return [
            'empty string' => ['', []],
            'invalid json' => ['some string', []],
            'empty array json' => ['[]', []],
            'valid bus card' => ['[{"transportation":"bus","transportationId":"1","startingPoint":"A","destination":"B"}]', [new BusCard('1', 'A', 'B')]],
            'bus card with missing type' => ['[{"transportationId":"1","startingPoint":"A","destination":"B"}]', []],
            'bus card with missing id' => ['[{"transportation":"bus","startingPoint":"A","destination":"B"}]', []],
            'bus card with missing starting point' => ['[{"transportation":"bus","transportationId":"1","destination":"B"}]', []],
            'bus card with missing destination' => ['[{"transportation":"bus","transportationId":"1","startingPoint":"A"}]', []],
            'valid train card' => ['[{"transportation":"train","transportationId":"1","startingPoint":"A","destination":"B","platform":"12","seat":"44"}]', [new TrainCard('1', 'A', 'B', '12', '44')]],
            'train card with missing platform' => ['[{"transportation":"train","transportationId":"1","startingPoint":"A","destination":"B","seat":"44"}]', []],
            'train card with missing seat' => ['[{"transportation":"train","transportationId":"1","startingPoint":"A","destination":"B","platform":"12"}]', []],
            'valid plane card' => ['[{"transportation":"flight","transportationId":"1","startingPoint":"A","destination":"B","gate":"12","seat":"44","baggagePolicy":"baggage"}]', [new AirplaneCard('1', 'A', 'B', '12', '44', 'baggage')]],
            'plane card with missing gate' => ['[{"transportation":"flight","transportationId":"1","startingPoint":"A","destination":"B","seat":"44","baggagePolicy":"baggage"}]', []],
            'plane card with missing seat' => ['[{"transportation":"flight","transportationId":"1","startingPoint":"A","destination":"B","gate":"12","baggagePolicy":"baggage"}]', []],
            'plane card with missing baggage policy' => ['[{"transportation":"flight","transportationId":"1","startingPoint":"A","destination":"B","gate":"12","seat":"44"}]', []],
            'different types of cards' => ['[{"transportation":"bus","transportationId":"1","startingPoint":"A","destination":"B"},{"transportation":"train","transportationId":"1","startingPoint":"A","destination":"B","platform":"12","seat":"44"},{"transportation":"flight","transportationId":"1","startingPoint":"A","destination":"B","gate":"12","seat":"44","baggagePolicy":"baggage"}]', [
                new BusCard('1', 'A', 'B'),
                new TrainCard('1', 'A', 'B', '12', '44'),
                new AirplaneCard('1', 'A', 'B', '12', '44', 'baggage')
            ]]
        ];
    }

    /**
     * @dataProvider provideJson
     * @param string $json
     * @param BoardingCard[] $expectedResult
     */
    public function testGetFromJson(string $json, array $expectedResult) {
        $cut = new BoardingCards($json);
        $this->assertEquals($expectedResult, $cut->getAll());
    }

}