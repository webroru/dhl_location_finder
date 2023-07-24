<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\API\Entity;

use Drupal\dhl_location_finder\API\Entity\Address;
use Drupal\dhl_location_finder\API\Entity\Location;
use Drupal\dhl_location_finder\API\Entity\OpeningHours;
use Drupal\dhl_location_finder\API\Entity\Place;
use Drupal\Tests\UnitTestCase;

class LocationTest extends UnitTestCase
{
    public function testCreateLocationEntity(): void
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

        $this->assertEquals('Postfiliale 502', $location->getName());
        $this->assertEquals('DE', $location->getPlace()->getAddress()->getCountryCode());
        $this->assertEquals('08:00:00', $location->getOpeningHours()[0]->getOpens());
    }
}
