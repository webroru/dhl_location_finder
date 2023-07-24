<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\API;

use Drupal\dhl_location_finder\API\Entity\Address;
use Drupal\dhl_location_finder\API\Entity\Location;
use Drupal\dhl_location_finder\API\Entity\OpeningHours;
use Drupal\dhl_location_finder\API\Entity\Place;
use Drupal\dhl_location_finder\API\LocationAdapter;
use Drupal\Tests\UnitTestCase;

class LocationAdapterTest extends UnitTestCase
{
    public function testLocationAdapter(): void
    {
        $address = (new Address())
            ->setCountryCode('DE')
            ->setPostalCode('53113')
            ->setAddressLocality('Bonn')
            ->setStreetAddress('Charles-de-Gaulle-Str. 20')
        ;
        $place = (new Place())
            ->setAddress($address)
        ;

        $openingHours = (new OpeningHours())
            ->setOpens('08:00:00')
            ->setCloses('17:00:00')
            ->setDayOfWeek('http://schema.org/Monday')
        ;

        $location = (new Location())
            ->setName('Postfiliale 502')
            ->setPlace($place)
            ->setOpeningHours([$openingHours])
        ;

        $adapter = new LocationAdapter($location);

        $this->assertEquals('Postfiliale 502', $adapter->getName());
        $this->assertEquals('DE', $adapter->getAddress()->getCountryCode());
        $this->assertEquals('08:00:00 - 17:00:00', $adapter->getOpeningHours()->getMonday());
    }
}
