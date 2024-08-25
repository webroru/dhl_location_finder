<?php

declare(strict_types=1);

namespace Drupal\Tests\location_finder\API\Dhl;

use Drupal\location_finder\API\Dhl\Client;
use Drupal\location_finder\API\Dhl\DTO\LocationsDTO;
use Drupal\location_finder\API\Dhl\LocationProvider;
use Drupal\Tests\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;

class LocationProviderTest extends UnitTestCase
{
    private Client|MockObject $clientMock;
    private Serializer|MockObject $serializerMock;
    private LocationProvider $locationProvider;

    public function testFindByAddress(): void
    {
        $this->clientMock->expects($this->once())
            ->method('findByAddress')
            ->willReturn([]);

        $this->serializerMock->expects($this->once())
            ->method('deserialize')
            ->with([], LocationsDTO::class, JsonEncoder::FORMAT)
            ->willReturn(new LocationsDTO([]));

        $this->locationProvider->findByAddress('DE', 'Bonn', '53113');
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->clientMock = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->serializerMock = $this->getMockBuilder(Serializer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->locationProvider = new LocationProvider($this->clientMock, $this->serializerMock);
    }
}
