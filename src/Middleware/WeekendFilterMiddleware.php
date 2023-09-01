<?php

declare(strict_types=1);

namespace Drupal\location_finder\Middleware;

use Drupal\location_finder\Entity\Location;

class WeekendFilterMiddleware extends MiddlewareAbstract
{
    public function handle(Location $location): ?Location
    {
        return $location->getOpeningHours()->getSaturday() && $location->getOpeningHours()->getSunday()
            ? parent::handle($location)
            : null;
    }
}
