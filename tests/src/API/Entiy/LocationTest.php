<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\API;

use Drupal\dhl_location_finder\API\Entity\Address;
use Drupal\dhl_location_finder\API\Entity\Location;
use Drupal\dhl_location_finder\API\Entity\OpeningHours;
use Drupal\dhl_location_finder\API\Entity\Place;
use Drupal\Tests\UnitTestCase;

class LocationTest extends UnitTestCase
{
    public function testCreateLocationDTO(): void
    {
        $addressData = [
            'countryCode' => 'DE',
            'postalCode' => '53113',
            'addressLocality' => 'Bonn',
            'streetAddress' => 'Charles-de-Gaulle-Str. 20',
        ];
        $address = new Address(...$addressData);
        $place = new Place($address);

        $openingHoursData = [
            'opens' => '08:00:00',
            'closes' => '17:00:00',
            'dayOfWeek' => 'http://schema.org/Monday'
        ];
        $openingHours = new OpeningHours(...$openingHoursData);

        $location = new Location('Postfiliale 502', $place, [$openingHours]);

        $this->assertEquals('Postfiliale 502', $location->getName());
        $this->assertEquals('DE', $location->getPlace()->getAddress()->getCountryCode());
        $this->assertEquals('08:00:00', $location->getOpeningHours()[0]->getOpens());
    }
}
