<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\API\Dhl\Entity;

use Drupal\dhl_location_finder\API\Dhl\Entity\Address;
use Drupal\Tests\UnitTestCase;

class AddressTest extends UnitTestCase
{
    public function testCreateAddressEntity(): void
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
