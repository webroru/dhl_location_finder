<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\Middleware;

use Drupal\dhl_location_finder\API\Entity\Location;
use Drupal\dhl_location_finder\API\Entity\OpeningHours;
use Drupal\dhl_location_finder\Middleware\WeekendFilterMiddleware;
use Drupal\Tests\UnitTestCase;

class WeekendFilterMiddlewareTest extends UnitTestCase
{
    public function testNullResult(): void
    {
        $location = (new Location())
            ->setName('Should be filtered')
            ->setOpeningHours([
                (new OpeningHours())
                    ->setDayOfWeek('http://schema.org/Monday')
                ,
            ])
        ;

        $middleware = new WeekendFilterMiddleware();

        $result = $middleware->handle($location);

        $this->assertNull($result);
    }

    public function testPassResult(): void
    {
        $location = (new Location())
            ->setName('Should stay')
            ->setOpeningHours([
                (new OpeningHours())
                    ->setDayOfWeek('http://schema.org/Saturday')
                ,
                (new OpeningHours())
                    ->setDayOfWeek('http://schema.org/Sunday')
                ,
            ])
        ;

        $middleware = new WeekendFilterMiddleware();

        $result = $middleware->handle($location);

        $this->assertEquals('Should stay', $result->getName());
    }
}
