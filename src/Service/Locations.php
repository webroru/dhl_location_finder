<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\Service;

use Drupal\dhl_location_finder\API\DTO\LocationsDTO;
use Drupal\dhl_location_finder\API\LocationProvider;

final readonly class Locations
{
    public function __construct(
        private LocationProvider $locationProvider,
    ) {
    }

    public function findByAddress(string $countryCode, string $addressLocality, string $postalCode): LocationsDTO
    {
        return $this->locationProvider->findByAddress($countryCode, $addressLocality, $postalCode);
    }
}
