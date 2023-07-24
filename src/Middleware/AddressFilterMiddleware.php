<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\Middleware;

use Drupal\dhl_location_finder\Entity\Location;

class AddressFilterMiddleware
{
    public function handle(Location $location): ?Location
    {
        $address = $location->getPlace()->getAddress()->getStreetAddress();
        preg_match(' (\d+)', $address, $matches);

        return (isset($matches[1])) && $matches[1] % 2 === 0 ?  $location : null;
    }
}
