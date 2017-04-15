<?php

namespace TripSorter\BoardingCard;

abstract class BoardingCard {

    /** @var string */
    private $transportationId;

    /** @var string */
    private $startingPoint;

    /** @var string */
    private $destination;

    /**
     * BoardingCard constructor.
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
        assert(
            $transportationId !== '',
            'transportationId cannot be empty'
        );

        assert(
            $startingPoint !== '',
            'startingPoint cannot be empty'
        );
        assert(
            $destination !== '',
            'destination cannot be empty'
        );

        $this->transportationId = $transportationId;
        $this->startingPoint = $startingPoint;
        $this->destination = $destination;
    }

    /** @return string */
    public abstract function getTransportationType(): string;

    /** @return string */
    public function getTransportationId(): string {
        return $this->transportationId;
    }

    /** @return string */
    public function getStartingPoint(): string {
        return $this->startingPoint;
    }

    /** @return string */
    public function getDestination(): string {
        return $this->destination;
    }

}