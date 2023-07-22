<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\Entity;

use Drupal\dhl_location_finder\Entity\Address;
use Drupal\Tests\UnitTestCase;

class AddressTest extends UnitTestCase
{
    public function testCreateLocationDTO(): void
    {
        $address = (new Address())
            ->setCountryCode('DE')
            ->setPostalCode('53113')
            ->setAddressLocality('Bonn')
            ->setStreetAddress('Charles-de-Gaulle-Str. 20')
        ;

        $this->assertEquals('DE', $address->getCountryCode());
        $this->assertEquals('53113', $address->getPostalCode());
        $this->assertEquals('Bonn', $address->getAddressLocality());
        $this->assertEquals('Charles-de-Gaulle-Str. 20', $address->getStreetAddress());
    }
}
