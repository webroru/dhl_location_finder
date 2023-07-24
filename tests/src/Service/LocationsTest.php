<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\Service;

use Drupal\dhl_location_finder\API\Client;
use Drupal\dhl_location_finder\API\DTO\LocationsDTO;
use Drupal\dhl_location_finder\Service\Locations;
use Drupal\Tests\UnitTestCase;
use Symfony\Component\PropertyInfo\Extractor\ConstructorExtractor;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class LocationsTest extends UnitTestCase
{
    public function testGetLocations(): void
    {
        $guzzleClient = new \GuzzleHttp\Client();
        $apiClient = new Client($guzzleClient);
        $phpDocExtractor = new PhpDocExtractor();
        $typeExtractor   = new PropertyInfoExtractor(
            typeExtractors: [ new ConstructorExtractor([$phpDocExtractor]), $phpDocExtractor, new ReflectionExtractor()]
        );

        $serializer = new Serializer(
            normalizers: [
                new ObjectNormalizer(propertyTypeExtractor: $typeExtractor),
                new ArrayDenormalizer(),
            ],
            encoders: [new JsonEncoder()]
        );

        $service = new Locations($apiClient, $serializer);

        $locationsDto = $service->findByAddress('DE', 'Bonn', '53113');

        $this->assertInstanceOf(LocationsDTO::class, $locationsDto);
    }
}
