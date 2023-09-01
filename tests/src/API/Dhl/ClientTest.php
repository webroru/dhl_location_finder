<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\API\Dhl;

use Drupal\dhl_location_finder\API\Dhl\Client;
use Drupal\Tests\UnitTestCase;

class ClientTest extends UnitTestCase
{
    public function testClientFetchesMetadata(): void
    {
        $client = new \GuzzleHttp\Client();
        $client = new Client($client);
        $json = $client->findByAddress('DE', 'Bonn', '53113');
        $data = json_decode($json, true);

        $this->assertSame('Packstation 207', $data['locations'][0]['name']);
        $this->assertSame('DE', $data['locations'][0]['place']['address']['countryCode']);
    }
}
