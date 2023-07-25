<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\Middleware;

use Drupal\dhl_location_finder\API\Entity\Address;
use Drupal\dhl_location_finder\API\Entity\Location;
use Drupal\dhl_location_finder\API\Entity\OpeningHours;
use Drupal\dhl_location_finder\API\Entity\Place;
use Drupal\dhl_location_finder\Middleware\AdapterMiddleware;
use Drupal\Tests\UnitTestCase;

class AdapterMiddlewareTest extends UnitTestCase
{
    public function testAdapterMiddleware(): void
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

        $middleware = new AdapterMiddleware();
        $result = $middleware->handle($location);

        $this->assertInstanceOf(\Drupal\dhl_location_finder\Entity\Location::class, $result);
    }
}
