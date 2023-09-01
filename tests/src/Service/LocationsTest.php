<?php

declare(strict_types=1);

namespace Drupal\Tests\location_finder\Service;

use Drupal\location_finder\API\Dhl\Client;
use Drupal\location_finder\API\Dhl\LocationProvider;
use Drupal\location_finder\Entity\Location;
use Drupal\location_finder\Middleware\AddressFilterMiddleware;
use Drupal\location_finder\Middleware\LocationHandler;
use Drupal\location_finder\Middleware\WeekendFilterMiddleware;
use Drupal\location_finder\Service\Locations;
use Drupal\Tests\UnitTestCase;
use Symfony\Component\PropertyInfo\Extractor\ConstructorExtractor;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class LocationsTest extends UnitTestCase
{
    private Locations $service;
    protected function setUp(): void
    {
        parent::setUp();

        $guzzleClient = new \GuzzleHttp\Client();
        $apiClient = new Client($guzzleClient);
        $phpDocExtractor = new PhpDocExtractor();
        $typeExtractor  = new PropertyInfoExtractor(
            typeExtractors: [ new ConstructorExtractor([$phpDocExtractor]), $phpDocExtractor, new ReflectionExtractor()]
        );

        $serializer = new Serializer(
            normalizers: [
                new ObjectNormalizer(propertyTypeExtractor: $typeExtractor),
                new ArrayDenormalizer(),
            ],
            encoders: [new JsonEncoder(), new YamlEncoder()]
        );

        $locationProvider = new LocationProvider($apiClient, $serializer);
        $addressFilterMiddleware = new AddressFilterMiddleware();
        $weekendFilterMiddleware = new WeekendFilterMiddleware();
        $locationHandler = new LocationHandler($addressFilterMiddleware, $weekendFilterMiddleware);

        $this->service = new Locations($locationProvider, $locationHandler, $serializer);
    }

    public function testGetLocations(): void
    {
        $locations = $this->service->findByAddress('DE', 'Bonn', '53113');

        $this->assertInstanceOf(Location::class, $locations[0]);
    }

    public function testProcessLocations(): void
    {
        $locations = $this->service->findByAddress('DE', 'Bonn', '53113');
        $locationsProcessed = $this->service->processLocations($locations);

        $this->assertInstanceOf(Location::class, $locationsProcessed[0]);
    }

    public function testConvertToYaml(): void
    {
        $locations = $this->service->findByAddress('DE', 'Bonn', '53113');
        $yaml = $this->service->convertToYaml($locations);

        $this->assertIsString($yaml);
    }
}
