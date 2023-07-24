<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\API\Entity;

use Drupal\dhl_location_finder\Entity\Address;
use Drupal\dhl_location_finder\Entity\Location;
use Drupal\dhl_location_finder\Entity\OpeningHours;
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

        $openingHours = (new OpeningHours())
            ->setMonday('00:00:00 - 23:59:00')
            ->setTuesday('00:00:00 - 23:59:00')
            ->setWednesday('00:00:00 - 23:59:00')
            ->setThursday('00:00:00 - 23:59:00')
            ->setFriday('00:00:00 - 23:59:00')
            ->setSaturday('00:00:00 - 23:59:00')
            ->setSunday('00:00:00 - 23:59:00')
        ;

        $location = (new Location())
            ->setName('Postfiliale 502')
            ->setAddress($address)
            ->setOpeningHours($openingHours)
        ;

        $this->assertEquals('Postfiliale 502', $location->getName());
        $this->assertEquals('DE', $location->getAddress()->getCountryCode());
        $this->assertEquals('00:00:00 - 23:59:00', $location->getOpeningHours()->getMonday());
    }
}
