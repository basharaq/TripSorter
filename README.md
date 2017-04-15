# TripSorter
A small package for creating collections of boarding cards for different transportation types, sorting them and creating a trip listing out of them

# Downloading and running tests
```git clone git@github.com:basharaq/TripSorter.git```

```composer install```

```composer test```

# Usage
```
<?php

require_once 'BoardingCard/BoardingCard.php';
require_once 'BoardingCard/AirplaneCard.php';
require_once 'BoardingCard/BoardingCards.php';
require_once 'BoardingCard/BusCard.php';
require_once 'BoardingCard/TrainCard.php';
require_once 'BoardingCardSorter.php';
require_once 'TripListing.php';

$boardingCards = new \TripSorter\BoardingCard\BoardingCards(
    '[{"transportation":"flight","transportationId":"RJ 191","startingPoint":"Frankfurt Airport","destination":"Amman","gate":"12A","seat":"10A","baggagePolicy":""},{"transportation":"bus","transportationId":"732","startingPoint":"Kirchplatz, Dusseldorf","destination":"Dusseldorf HBF"},{"transportation":"train","transportationId":"ICE 2987","startingPoint":"Dusseldorf HBF","destination":"Frankfurt Airport","platform":"12","seat":"44"}]'
);

$sorter = new \TripSorter\BoardingCardSorter();
$sortedList = $sorter->getSortedList($boardingCards->getAll());
$tripListing = new \TripSorter\TripListing();
var_dump($tripListing->getFromBoardingCards($sortedList));
```

output:

```
array(4) {
  [0]=>
  string(79) "Take bus 732 from Kirchplatz, Dusseldorf to Dusseldorf HBF. No seat assignment."
  [1]=>
  string(90) "Take train ICE 2987 from Dusseldorf HBF to Frankfurt Airport, platform 12. Sit in seat 44."
  [2]=>
  string(78) "Take flight RJ 191 from Frankfurt Airport to Amman, gate 12A. Sit in seat 10A."
  [3]=>
  string(40) "You have reached your final destination."
}
```