<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\Middleware;

use Drupal\dhl_location_finder\Entity\Location;

class WeekendFilterMiddleware
{
    public function handle(Location $location): ?Location
    {
        return $location->getOpeningHours()->getSaturday() && $location->getOpeningHours()->getSunday()
            ? $location
            : null;
    }
}
