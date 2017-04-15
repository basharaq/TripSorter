<?php

namespace TripSorter\BoardingCard;

class AirplaneCard extends BoardingCard {

    /** @var string */
    private $gate;

    /** @var string */
    private $seatNumber;

    /** @var string */
    private $baggagePolicy;

    /**
     * AirplaneCard constructor.
     *
     * @param string $transportationId
     * @param string $startingPoint
     * @param string $destination
     * @param string $gate
     * @param string $seatNumber
     * @param string $baggagePolicy
     */
    public function __construct(
        string $transportationId,
        string $startingPoint,
        string $destination,
        string $gate,
        string $seatNumber,
        string $baggagePolicy = ''
    ) {
        parent::__construct(
            $transportationId,
            $startingPoint,
            $destination
        );

        assert(
            $gate !== '',
            'gate number cannot be empty'
        );
        assert(
            $seatNumber !== '',
            'seatNumber cannot be empty'
        );

        $this->gate = $gate;
        $this->seatNumber = $seatNumber;
        $this->baggagePolicy = $baggagePolicy;
    }

    /** @return string */
    public function getTransportationType(): string {
        return 'flight';
    }

    /** @return string */
    public function getGate(): string {
        return $this->gate;
    }

    /** @return string */
    public function getSeatNumber(): string {
        return $this->seatNumber;
    }

    /** @return string */
    public function getBaggagePolicy(): string {
        return $this->baggagePolicy;
    }
}