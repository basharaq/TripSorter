<?php

namespace TripSorter\BoardingCard;

class TrainCard extends BoardingCard {

    /** @var string */
    private $platform;

    /** @var string */
    private $seatNumber;

    /**
     * TrainCard constructor.
     *
     * @param string $transportationId
     * @param string $startingPoint
     * @param string $destination
     * @param string $platform
     * @param string $seatNumber
     */
    public function __construct(
        string $transportationId,
        string $startingPoint,
        string $destination,
        string $platform,
        string $seatNumber = ''
    ) {
        parent::__construct(
            $transportationId,
            $startingPoint,
            $destination
        );

        assert(
            $platform !== '',
            'platform cannot be empty'
        );

        $this->platform = $platform;
        $this->seatNumber = $seatNumber;
    }

    /** @return string */
    public function getPlatform(): string {
        return $this->platform;
    }

    /** @return string */
    public function getSeatNumber(): string {
        return $this->seatNumber;
    }

    /** @return string */
    public function getTransportationType(): string {
        return 'train';
    }
}