<?php

declare(strict_types=1);

namespace Drupal\Tests\location_finder\Service;

use Drupal\location_finder\API\Dhl\LocationProvider;
use Drupal\location_finder\Entity\Location;
use Drupal\location_finder\Middleware\LocationHandler;
use Drupal\location_finder\Service\Locations;
use Drupal\Tests\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class LocationsTest extends UnitTestCase
{
    private LocationProvider|MockObject $locationProviderMock;
    private LocationHandler|MockObject $locationHandlerMock;
    private Serializer|MockObject $serializerMock;
    private Locations $service;

    public function testFindByAddress(): void
    {
        $this->locationProviderMock->expects($this->once())
            ->method('findByAddress')
            ->willReturn([]);

        $this->service->findByAddress('DE', 'Bonn', '53113');
    }

    public function testProcessLocations(): void
    {
        $this->locationHandlerMock->expects($this->once())
            ->method('handle')
            ->with($this->isInstanceOf(Location::class))
            ->willReturn(new Location());

        $this->service->processLocations([new Location()]);
    }

    public function testConvertToYaml(): void
    {
        $this->serializerMock->expects($this->once())
            ->method('serialize')
            ->with([new Location()], YamlEncoder::FORMAT)
            ->willReturn('yaml');

        $this->service->convertToYaml([new Location()]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->locationProviderMock = $this->getMockBuilder(LocationProvider::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->locationHandlerMock = $this->getMockBuilder(LocationHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->serializerMock = $this->getMockBuilder(Serializer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->service = new Locations($this->locationProviderMock, $this->locationHandlerMock, $this->serializerMock);
    }
}
