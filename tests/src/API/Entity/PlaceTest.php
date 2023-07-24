<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\API\Entity;

use Drupal\dhl_location_finder\API\Entity\Address;
use Drupal\dhl_location_finder\API\Entity\Place;
use Drupal\Tests\UnitTestCase;

class PlaceTest extends UnitTestCase
{
    public function testCreatePlaceEntity(): void
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

        $this->assertEquals('DE', $place->getAddress()->getCountryCode());
    }
}
