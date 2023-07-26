<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\API;

use Drupal\dhl_location_finder\API\DTO\LocationsDTO;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

readonly class LocationProvider
{
    public function __construct(
        private Client $client,
        private SerializerInterface $serializer,
    ) {
    }

    public function findByAddress(string $countryCode, string $addressLocality, string $postalCode): LocationsDTO
    {
        $data = $this->client->findByAddress($countryCode, $addressLocality, $postalCode);
        return $this->createDto($data, LocationsDTO::class);
    }

    private function createDto(string $data, string $className): object
    {
        return $this->serializer->deserialize($data, $className, JsonEncoder::FORMAT);
    }
}
