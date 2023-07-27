<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\Service;

use Drupal\dhl_location_finder\API\DTO\LocationsDTO;
use Drupal\dhl_location_finder\API\Entity\Location as ApiLocation;
use Drupal\dhl_location_finder\API\LocationAdapter;
use Drupal\dhl_location_finder\API\LocationProvider;
use Drupal\dhl_location_finder\Entity\Location;
use Drupal\dhl_location_finder\Middleware\LocationHandler;

final readonly class Locations
{
    public function __construct(
        private LocationProvider $locationProvider,
        private LocationHandler $locationHandler,
    ) {
    }

    public function findByAddress(string $countryCode, string $addressLocality, string $postalCode): LocationsDTO
    {
        return $this->locationProvider->findByAddress($countryCode, $addressLocality, $postalCode);
    }

    /**
     * @param ApiLocation[] $locations
     * @return Location[]
     */
    public function processLocations(array $locations): array
    {
        $result = [];
        foreach ($locations as $location) {
            $handledLocation = $this->locationHandler->handle(new LocationAdapter($location));

            if ($handledLocation) {
                $result[] = $handledLocation;
            }
        }

        return $result;
    }
}
