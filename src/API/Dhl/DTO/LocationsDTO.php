<?php

declare(strict_types=1);

namespace Drupal\location_finder\API\Dhl\DTO;

use Drupal\location_finder\API\Dhl\Entity\Location;

final readonly class LocationsDTO
{
    /**
     * @param Location[] $locations
     */
    public function __construct(public array $locations)
    {
    }
}
