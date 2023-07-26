<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\API;

use Drupal\dhl_location_finder\API\Client;
use Drupal\dhl_location_finder\API\DTO\LocationsDTO;
use Drupal\dhl_location_finder\API\LocationProvider;
use Drupal\Tests\UnitTestCase;
use Symfony\Component\PropertyInfo\Extractor\ConstructorExtractor;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class LocationProviderTest extends UnitTestCase
{
    public function testClientFetchesMetadata(): void
    {
        $client = new \GuzzleHttp\Client();
        $client = new Client($client);
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

        $locationProvider = new LocationProvider($client, $serializer);

        $locationDto = $locationProvider->findByAddress('DE', 'Bonn', '53113');

        $this->assertInstanceOf(LocationsDTO::class, $locationDto);
    }
}
