<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\API;

use Drupal\dhl_location_finder\API\Entity\Address;
use Drupal\Tests\UnitTestCase;

class AddressTest extends UnitTestCase
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

        $this->assertEquals('DE', $address->getCountryCode());
        $this->assertEquals('53113', $address->getPostalCode());
        $this->assertEquals('Bonn', $address->getAddressLocality());
        $this->assertEquals('Charles-de-Gaulle-Str. 20', $address->getStreetAddress());
    }
}
