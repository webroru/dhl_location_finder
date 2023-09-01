<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\Middleware;

use Drupal\dhl_location_finder\API\Dhl\Entity\Address;
use Drupal\dhl_location_finder\API\Dhl\Entity\Location;
use Drupal\dhl_location_finder\API\Dhl\Entity\OpeningHours;
use Drupal\dhl_location_finder\API\Dhl\Entity\Place;
use Drupal\dhl_location_finder\API\Dhl\LocationAdapter;
use Drupal\dhl_location_finder\Middleware\AddressFilterMiddleware;
use Drupal\Tests\UnitTestCase;

class AddressFilterMiddlewareTest extends UnitTestCase
{
    public function testNullResult(): void
    {
        $address = (new Address())
            ->setCountryCode('DE')
            ->setPostalCode('53113')
            ->setAddressLocality('Bonn')
            ->setStreetAddress('Maximilianstr. 7')
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

        $adapter = new LocationAdapter($location);
        $middleware = new AddressFilterMiddleware();
        $result = $middleware->handle($adapter);

        $this->assertNull($result);
    }

    public function testPassResult(): void
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
            ->setName('Should stay')
            ->setPlace($place)
            ->setOpeningHours([$openingHours])
        ;

        $adapter = new LocationAdapter($location);
        $middleware = new AddressFilterMiddleware();
        $result = $middleware->handle($adapter);

        $this->assertEquals('Should stay', $result->getName());
    }
}
