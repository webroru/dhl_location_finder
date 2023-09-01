<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\API\Dhl;

use Drupal\dhl_location_finder\API\LocationProviderInterface;
use Drupal\dhl_location_finder\API\Dhl\DTO\LocationsDTO;
use Drupal\dhl_location_finder\Entity\Location;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

readonly class LocationProvider implements LocationProviderInterface
{
    public function __construct(
        private Client $client,
        private SerializerInterface $serializer,
    ) {
    }

    /**
     * @return Location[]
     */
    public function findByAddress(string $countryCode, string $addressLocality, string $postalCode): array
    {
        $data = $this->client->findByAddress($countryCode, $addressLocality, $postalCode);
        $dto = $this->createDto($data, LocationsDTO::class);
        return array_map(fn(Entity\Location $location) => new LocationAdapter($location), $dto->locations);
    }

    private function createDto(string $data, string $className): LocationsDTO
    {
        return $this->serializer->deserialize($data, $className, JsonEncoder::FORMAT);
    }
}
