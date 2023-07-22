<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\API;

use Drupal\dhl_location_finder\API\Entity\Address;
use Drupal\dhl_location_finder\API\Entity\Place;
use Drupal\Tests\UnitTestCase;

class PlaceTest extends UnitTestCase
{
    public function testCreateLocationDTO(): void
    {
        $data = [
            'countryCode' => 'DE',
            'postalCode' => '53113',
            'addressLocality' => 'Bonn',
            'streetAddress' => 'Charles-de-Gaulle-Str. 20',
          ];
        $address = new Address(...$data);
        $place = new Place($address);

        $this->assertEquals('DE', $place->getAddress()->getCountryCode());
    }
}
