<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\Middleware;

use Drupal\dhl_location_finder\API\Entity\Address;
use Drupal\dhl_location_finder\API\Entity\Location;
use Drupal\dhl_location_finder\API\Entity\OpeningHours;
use Drupal\dhl_location_finder\API\Entity\Place;
use Drupal\dhl_location_finder\API\LocationAdapter;
use Drupal\dhl_location_finder\Middleware\WeekendFilterMiddleware;
use Drupal\Tests\UnitTestCase;

class WeekendFilterMiddlewareTest extends UnitTestCase
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
            ->setName('Should be filtered')
            ->setPlace($place)
            ->setOpeningHours([$openingHours])
        ;

        $adapter = new LocationAdapter($location);
        $middleware = new WeekendFilterMiddleware();
        $result = $middleware->handle($adapter);

        $this->assertNull($result);
    }

    public function testPassResult(): void
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

        $openingHours = [
            (new OpeningHours())
                ->setOpens('08:00:00')
                ->setCloses('17:00:00')
                ->setDayOfWeek('http://schema.org/Saturday'),
            (new OpeningHours())
                ->setOpens('08:00:00')
                ->setCloses('17:00:00')
                ->setDayOfWeek('http://schema.org/Sunday'),
        ];

        $location = (new Location())
            ->setName('Should stay')
            ->setPlace($place)
            ->setOpeningHours($openingHours)
        ;

        $adapter = new LocationAdapter($location);
        $middleware = new WeekendFilterMiddleware();
        $result = $middleware->handle($adapter);

        $this->assertEquals('Should stay', $result->getName());
    }
}
