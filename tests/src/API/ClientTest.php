<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\API;

use Drupal\dhl_location_finder\API\Client;
use Drupal\Tests\UnitTestCase;

class ClientTest extends UnitTestCase
{
    public function testClientFetchesMetadata(): void
    {
        $client = new \GuzzleHttp\Client();
        $client = new Client($client);
        $data = $client->findByAddress('DE', 'Bonn', '53113');

        $this->assertSame('Packstation 207', $data['locations'][0]['name']);
        $this->assertSame('DE', $data['locations'][0]['place']['address']['countryCode']);
    }
}
