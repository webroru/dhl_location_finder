<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\API;

final readonly class LocationsDTO
{
    public array $locations;
    public function __construct(array $locations)
    {
        $collection = [];
        foreach ($locations as $location) {
            $collection[] = new LocationDTO(...$location);
        }

        $this->locations = $collection;
    }
}
