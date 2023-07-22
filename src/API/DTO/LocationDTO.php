<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\API\DTO;

final readonly class LocationDTO
{
    public function __construct(
        public string $url,
        public array $location,
        public string $name,
        public int $distance,
        public array $place,
        public array $openingHours,
        public array $closurePeriods,
        public array $serviceTypes,
        public array $averageCapacityDayOfWeek,
    ) {
    }
}
