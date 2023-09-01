<?php

declare(strict_types=1);

namespace Drupal\Tests\location_finder\API\Dhl;

use Drupal\location_finder\API\Dhl\Entity\Address;
use Drupal\location_finder\API\Dhl\Entity\Location;
use Drupal\location_finder\API\Dhl\Entity\OpeningHours;
use Drupal\location_finder\API\Dhl\Entity\Place;
use Drupal\location_finder\API\Dhl\LocationAdapter;
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
