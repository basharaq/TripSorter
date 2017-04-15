<?php

namespace TripSorter\BoardingCard;

class BusCard extends BoardingCard {

    /**
     * BusCard constructor.
     *
     * @param string $transportationId
     * @param string $startingPoint
     * @param string $destination
     */
    public function __construct(
        string $transportationId,
        string $startingPoint,
        string $destination
    ) {
        parent::__construct(
            $transportationId,
            $startingPoint,
            $destination
        );
    }

    /** @return string */
    public function getTransportationType(): string {
        return 'bus';
    }
}