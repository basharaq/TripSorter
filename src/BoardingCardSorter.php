<?php

namespace TripSorter;

use TripSorter\BoardingCard\BoardingCard;

class BoardingCardSorter {

    /**
     * @param BoardingCard[] $boardingCards
     *
     * @return BoardingCard[]
     */
    public function getSortedList(array $boardingCards): array {
        if (count($boardingCards) === 0) {
            return [];
        }

        $sortedList = [];
        $indexes = $this->getIndexes($boardingCards);
        $startingPointIndex = $indexes['startingPoint'];
        $initialStartingPoint = $this->getInitialStartingPoint($startingPointIndex, $indexes['destination']);

        if ($initialStartingPoint === '') {
            $initialStartingPoint = $boardingCards[0]->getStartingPoint();
        }

        /** @var BoardingCard $nextCard */
        $nextCard = isset($startingPointIndex[$initialStartingPoint])
            ? $startingPointIndex[$initialStartingPoint]
            : null;
        $cardsCount = count($boardingCards);
        $counter = 0;

        while ($nextCard !== null && $counter < $cardsCount) {
            $sortedList[] = $nextCard;
            $counter++;
            $nextStop = $nextCard->getDestination();
            $nextCard = isset($startingPointIndex[$nextStop])
                ? $startingPointIndex[$nextStop]
                : null;
        }

        return $sortedList;
    }

    /**
     * @param BoardingCard[] $boardingCards
     *
     * @return array
     */
    private function getIndexes(array $boardingCards): array {
        $startingPointIndex = [];
        $destinationIndex = [];

        foreach ($boardingCards as $boardingCard) {
            $startingPointIndex[$boardingCard->getStartingPoint()] = $boardingCard;
            $destinationIndex[$boardingCard->getDestination()] = null;
        }

        return [
            'startingPoint' => $startingPointIndex,
            'destination' => $destinationIndex
        ];
    }

    /**
     * @param BoardingCard[] $startingPointIndex
     * @param array $destinationIndex
     *
     * @return string
     */
    private function getInitialStartingPoint(array $startingPointIndex, array $destinationIndex): string {
        foreach ($startingPointIndex as $startingPoint => $unused) {
            if (!array_key_exists($startingPoint, $destinationIndex)) {
                return $startingPoint;
            }
        }

        return '';
    }

}