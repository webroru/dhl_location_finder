<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\Middleware;

use Drupal\dhl_location_finder\API\Entity\Location;
use Drupal\dhl_location_finder\API\Entity\OpeningHours;

class WeekendFilterMiddleware
{
    public function handle(Location $location): ?Location
    {
        $dasOfWeek = array_map(
            fn(OpeningHours $openingHours) => $openingHours->getDayOfWeek(),
            $location->getOpeningHours()
        );
        $isOpenOnSaturday = in_array('http://schema.org/Saturday', $dasOfWeek);
        $isOpenOnSunday = in_array('http://schema.org/Sunday', $dasOfWeek);

        return $isOpenOnSaturday && $isOpenOnSunday ? $location : null;
    }
}
