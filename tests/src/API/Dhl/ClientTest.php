<?php

declare(strict_types=1);

namespace Drupal\Tests\location_finder\API\Dhl;

use Drupal\location_finder\API\Dhl\Client;
use Drupal\location_finder\Exceptions\ApiException;
use Drupal\Tests\UnitTestCase;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ClientTest extends UnitTestCase
{
    private HttpClient|MockObject $httpClientMock;
    private ResponseInterface|MockObject $responseMock;
    private StreamInterface|MockObject $streamMock;
    private Client $client;

    public function testFindByAddress(): void
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

    public function testFindByAddressError(): void
    {
        $this->expectException(ApiException::class);

        $requestMock = $this->getMockBuilder(RequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->streamMock->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode(['detail' => 'Test response details']));

        $clientException = new ClientException('Test ClientException', $requestMock, $this->responseMock);

        $this->httpClientMock->expects($this->once())
            ->method('request')
            ->willThrowException($clientException);

        $this->client->findByAddress('DE', 'Bonn', '53113');
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
