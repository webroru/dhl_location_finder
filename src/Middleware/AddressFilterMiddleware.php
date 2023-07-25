<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\Middleware;

use Drupal\dhl_location_finder\Entity\Location;

class AddressFilterMiddleware
{
    public function handle(Location $location): ?Location
    {
        $address = $location->getAddress()->getStreetAddress();
        preg_match(' (\d+)', $address, $matches);

        return (isset($matches[0])) && $matches[0] % 2 === 0 ?  $location : null;
    }
}
