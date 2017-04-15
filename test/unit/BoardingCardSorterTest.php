<?php

namespace TripSorter\Test;

use PHPUnit\Framework\TestCase;
use TripSorter\BoardingCard\BusCard;
use TripSorter\BoardingCardSorter;

class BoardingCardSorterTest extends TestCase {

    public function provideBoardingCards() {
        $card1 = new BusCard('1', 'd', 'e');
        $card2 = new BusCard('2', 'a', 'b');
        $card3 = new BusCard('3', 'c', 'd');
        $card4 = new BusCard('4', 'b', 'c');
        $card5 = new BusCard('5', 'e', 'a');
        $card6 = new BusCard('6', 'f', 'e');
        $card7 = new BusCard('7', 'd', 'j');
        $card8 = new BusCard('8', 'k', 'l');

        return [
            'normal case with one initial starting point and one final destination' => [
                [$card1, $card2, $card3, $card4], [$card2, $card4, $card3, $card1]
            ],
            'empty list' => [
                [], []
            ],
            'only one card' => [
                [$card1], [$card1]
            ],
            'circular trip (i.e. initial starting point equal to final destination)' => [
                [$card1, $card2, $card3, $card4, $card5], [$card1, $card5, $card2, $card4, $card3]
            ],
            'disconnected trip' => [
                [$card1, $card2, $card3, $card4, $card8], [$card2, $card4, $card3, $card1]
            ],
            'two cards have the same starting point' => [
                [$card1, $card2, $card3, $card4, $card7], [$card2, $card4, $card3, $card7]
            ],
            'two cards have the same destination' => [
                [$card1, $card2, $card3, $card4, $card6], [$card2, $card4, $card3, $card1]
            ]
        ];
    }

    /**
     * @dataProvider provideBoardingCards
     * @param array $boardingCards
     * @param array $expectedResult
     */
    public function testSorting(array $boardingCards, array $expectedResult) {
        $cut = new BoardingCardSorter();
        $this->assertEquals($expectedResult, $cut->getSortedList($boardingCards));
    }

}