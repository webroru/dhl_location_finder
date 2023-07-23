<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\Middleware;

use Drupal\dhl_location_finder\Entity\Address;
use Drupal\dhl_location_finder\Entity\Location;
use Drupal\dhl_location_finder\Entity\Place;
use Drupal\dhl_location_finder\Middleware\AddressFilterMiddleware;
use Drupal\Tests\UnitTestCase;

class AddressFilterMiddlewareTest extends UnitTestCase
{
    public function testNullResult(): void
    {
        $address = (new Address())
            ->setStreetAddress('Maximilianstr. 7');

        $place = (new Place())
            ->setAddress($address);

        $location = (new Location())
            ->setName('Should be filtered')
            ->setPlace($place)
        ;

        $middleware = new AddressFilterMiddleware();

        $result = $middleware->handle($location);

        $this->assertNull($result);
    }

    public function testPassResult(): void
    {
        $address = (new Address())
            ->setStreetAddress('Charles-de-Gaulle-Str. 20');

        $place = (new Place())
            ->setAddress($address);

        $location = (new Location())
            ->setName('Should stay')
            ->setPlace($place)
        ;

        $middleware = new AddressFilterMiddleware();

        $result = $middleware->handle($location);

        $this->assertNull($result);
    }
}
