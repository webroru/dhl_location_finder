<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\API;

final readonly class LocationsDTO
{
    public function __construct(public array $locations)
    {
    }
}
