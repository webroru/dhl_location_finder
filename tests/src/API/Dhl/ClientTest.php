<?php

declare(strict_types=1);

namespace Drupal\Tests\location_finder\API\Dhl;

use Drupal\location_finder\API\Dhl\Client;
use Drupal\Tests\UnitTestCase;
use GuzzleHttp\Client as HttpClient;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ClientTest extends UnitTestCase
{
    private HttpClient|MockObject $httpClientMock;
    private ResponseInterface|MockObject $responseMock;
    private StreamInterface|MockObject $streamMock;
    private Client $client;

    public function testClientFetchesMetadata(): void
    {
        $this->httpClientMock->expects($this->once())
            ->method('get')
            ->willReturn($this->responseMock);

        $this->streamMock->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode([]));

        $json = $this->client->findByAddress('DE', 'Bonn', '53113');
        $locations = json_decode($json, true);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->httpClientMock = $this->getMockBuilder(HttpClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseMock = $this->getMockBuilder(ResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->streamMock = $this->getMockBuilder(StreamInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseMock->expects($this->any())
            ->method('getBody')
            ->willReturn($this->streamMock);

        $this->responseMock->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(0);

        $this->client = new Client($this->httpClientMock);
    }
}
