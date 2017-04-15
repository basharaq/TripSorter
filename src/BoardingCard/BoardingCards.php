<?php

namespace TripSorter\BoardingCard;

/**
 * Repository for retrieving a collection of BoardingCard objects from a JSON string
 */
class BoardingCards {

    /** @var string */
    private $json;

    /**
     * BoardingCards constructor.
     *
     * @param string $json
     */
    public function __construct(string $json) {
        $this->json = $json;
    }

    /**
     * @return BoardingCard[]
     */
    public function getAll(): array {
        $rawObjects = json_decode($this->json);

        if (!is_array($rawObjects)) {
            return [];
        }

        $boardingCards = [];

        foreach ($rawObjects as $rawObject) {
            if (
                !property_exists($rawObject, 'startingPoint')
                || !property_exists($rawObject, 'destination')
                || !property_exists($rawObject, 'transportationId')
                || !property_exists($rawObject, 'transportation')
            ) {
                continue;
            }

            if ($rawObject->transportation === 'bus') {
                $boardingCards[] = new BusCard(
                    $rawObject->transportationId,
                    $rawObject->startingPoint,
                    $rawObject->destination
                );
            }
            elseif (
                $rawObject->transportation === 'train'
                && property_exists($rawObject, 'platform')
                && property_exists($rawObject, 'seat')
            ) {
                $boardingCards[] = new TrainCard(
                    $rawObject->transportationId,
                    $rawObject->startingPoint,
                    $rawObject->destination,
                    $rawObject->platform,
                    $rawObject->seat
                );
            }
            elseif (
                $rawObject->transportation === 'flight'
                && property_exists($rawObject, 'gate')
                && property_exists($rawObject, 'seat')
                && property_exists($rawObject, 'baggagePolicy')
            ) {
                $boardingCards[] = new AirplaneCard(
                    $rawObject->transportationId,
                    $rawObject->startingPoint,
                    $rawObject->destination,
                    $rawObject->gate,
                    $rawObject->seat,
                    $rawObject->baggagePolicy
                );
            }
        }

        return $boardingCards;
    }

}