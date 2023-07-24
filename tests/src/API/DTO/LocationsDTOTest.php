<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\API\DTO;

use Drupal\dhl_location_finder\API\DTO\LocationsDTO;
use Drupal\dhl_location_finder\API\Entity\Address;
use Drupal\dhl_location_finder\API\Entity\Location;
use Drupal\dhl_location_finder\API\Entity\OpeningHours;
use Drupal\dhl_location_finder\API\Entity\Place;
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
