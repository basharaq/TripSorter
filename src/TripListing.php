<?php

namespace TripSorter;

use TripSorter\BoardingCard\AirplaneCard;
use TripSorter\BoardingCard\BoardingCard;
use TripSorter\BoardingCard\TrainCard;

class TripListing {

    /**
     * @param BoardingCard[] $boardingCards
     *
     * @return string[]
     */
    public function getFromBoardingCards(array $boardingCards): array {
        $listing = [];

        foreach ($boardingCards as $boardingCard) {
            $boardingLocation = '';
            $seatAssignment = 'No seat assignment';
            $baggagePolicy = '';

            if (
                $boardingCard instanceof TrainCard
                || $boardingCard instanceof AirplaneCard
            ) {
                if ($boardingCard instanceof TrainCard) {
                    $boardingLocation = ", platform {$boardingCard->getPlatform()}";
                }

                if ($boardingCard instanceof AirplaneCard) {
                    $boardingLocation = ", gate {$boardingCard->getGate()}";
                    $baggagePolicy = $boardingCard->getBaggagePolicy();

                    if (!empty($baggagePolicy)) {
                        $baggagePolicy = "\n{$baggagePolicy}.";
                    }
                }

                $seatNumber = $boardingCard->getSeatNumber();

                if (!empty($seatNumber)) {
                    $seatAssignment = "Sit in seat {$seatNumber}";
                }
            }

            $listing[] = "Take {$boardingCard->getTransportationType()} {$boardingCard->getTransportationId()} from {$boardingCard->getStartingPoint()} to {$boardingCard->getDestination()}{$boardingLocation}. {$seatAssignment}.{$baggagePolicy}";
        }

        if (count($listing) > 0) {
            $listing[] = 'You have reached your final destination.';
        }

        return $listing;
    }

}