<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\Service;

use Drupal\dhl_location_finder\API\Dhl\LocationProvider;
use Drupal\dhl_location_finder\Entity\Location;
use Drupal\dhl_location_finder\Middleware\LocationHandler;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\SerializerInterface;

final readonly class Locations
{
    public function __construct(
        private LocationProvider $locationProvider,
        private LocationHandler $locationHandler,
        private SerializerInterface $serializer,
    ) {
    }

    /**
     * @return Location[]
     */
    public function findByAddress(string $countryCode, string $addressLocality, string $postalCode): array
    {
        return $this->locationProvider->findByAddress($countryCode, $addressLocality, $postalCode);
    }

    /**
     * @param Location[] $locations
     * @return Location[]
     */
    public function processLocations(array $locations): array
    {
        $result = [];
        foreach ($locations as $location) {
            $handledLocation = $this->locationHandler->handle($location);

            if ($handledLocation) {
                $result[] = $handledLocation;
            }
        }

        return $result;
    }

    /**
     * @param Location[] $locations
     */
    public function convertToYaml(array $locations): string
    {
        return $this->serializer->serialize($locations, YamlEncoder::FORMAT);
    }
}
