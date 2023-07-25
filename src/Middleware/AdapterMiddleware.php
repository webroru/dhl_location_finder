<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\Middleware;

use Drupal\dhl_location_finder\API\Entity\Location as ApiLocation;
use Drupal\dhl_location_finder\API\LocationAdapter;
use Drupal\dhl_location_finder\Entity\Location;

class AdapterMiddleware
{
    public function handle(ApiLocation $location): Location
    {
        return new LocationAdapter($location);
    }
}
