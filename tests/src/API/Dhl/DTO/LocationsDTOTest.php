<?php

declare(strict_types=1);

namespace Drupal\Tests\location_finder\API\Dhl\DTO;

use Drupal\location_finder\API\Dhl\DTO\LocationsDTO;
use Drupal\location_finder\API\Dhl\Entity\Address;
use Drupal\location_finder\API\Dhl\Entity\Location;
use Drupal\location_finder\API\Dhl\Entity\OpeningHours;
use Drupal\location_finder\API\Dhl\Entity\Place;
use Drupal\Tests\UnitTestCase;

class LocationsDTOTest extends UnitTestCase
{
    public function testCreateLocationsDTO(): void
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
        $dto = new LocationsDTO([$location]);

        $this->assertSame('Postfiliale 502', $dto->locations[0]->getName());
        $this->assertSame('DE', $dto->locations[0]->getPlace()->getAddress()->getCountryCode());
    }
}
