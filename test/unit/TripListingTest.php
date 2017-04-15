<?php

namespace TripSorter\Test;

use PHPUnit\Framework\TestCase;
use TripSorter\BoardingCard\AirplaneCard;
use TripSorter\BoardingCard\BoardingCard;
use TripSorter\BoardingCard\BusCard;
use TripSorter\BoardingCard\TrainCard;
use TripSorter\TripListing;

class TripListingTest extends TestCase {

    public function provideBoardingCards() {
        $busCard = new BusCard('567', 'A', 'B');
        $trainCard = new TrainCard('ICE 123', 'B', 'C', '12A', '26');
        $trainCard2 = new TrainCard('ICE 466', 'B', 'C', '12A');
        $planeCard = new AirplaneCard('RJ191', 'C', 'D', '36B', '8A');
        $planeCard2 = new AirplaneCard('RJ345', 'D', 'E', '3C', '10A', 'Baggage will be transported from your last leg');

        return [
            'empty trip' => [[], []],
            'one bus card' => [
                [$busCard], [
                    "Take bus 567 from A to B. No seat assignment.",
                    'You have reached your final destination.'
                ]
            ],
            'one train card, with seat assignment' => [
                [$trainCard], [
                    "Take train ICE 123 from B to C, platform 12A. Sit in seat 26.",
                    'You have reached your final destination.'
                ]
            ],
            'one train card, no seat assignment' => [
                [$trainCard2], [
                    "Take train ICE 466 from B to C, platform 12A. No seat assignment.",
                    'You have reached your final destination.'
                ]
            ],
            'one plane card, with baggage policy' => [
                [$planeCard2], [
                    "Take flight RJ345 from D to E, gate 3C. Sit in seat 10A.\nBaggage will be transported from your last leg.",
                    'You have reached your final destination.'
                ]
            ],
            'one plane card, no baggage policy' => [
                [$planeCard], [
                    "Take flight RJ191 from C to D, gate 36B. Sit in seat 8A.",
                    'You have reached your final destination.'
                ]
            ],
            'mixture of cards' => [
                [$busCard, $trainCard, $planeCard, $planeCard2], [
                    "Take bus 567 from A to B. No seat assignment.",
                    "Take train ICE 123 from B to C, platform 12A. Sit in seat 26.",
                    "Take flight RJ191 from C to D, gate 36B. Sit in seat 8A.",
                    "Take flight RJ345 from D to E, gate 3C. Sit in seat 10A.\nBaggage will be transported from your last leg.",
                    'You have reached your final destination.'
                ]
            ]
        ];
    }
    /**
     * @dataProvider provideBoardingCards
     * @param BoardingCard[] $boardingCards
     * @param string[] $expectedResult
     */
    public function testGetFromBoardingCards(array $boardingCards, array $expectedResult) {
        $cut = new TripListing();
        $this->assertEquals($expectedResult, $cut->getFromBoardingCards($boardingCards));
    }

}