<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\Service;

use Drupal\dhl_location_finder\API\Client;
use Drupal\dhl_location_finder\Service\Locations;
use Drupal\Tests\UnitTestCase;

class LocationsTest extends UnitTestCase
{
    public function testGetLocations(): void
    {
        $guzzleClient = new \GuzzleHttp\Client();
        $apiClient = new Client($guzzleClient);
        $service = new Locations($apiClient);

        $locations = $service->findByAddress('DE', 'Bonn', '53113');

        $this->assertSame('Postfiliale 502', $locations->locations[0]->getName());
        $this->assertSame('DE', $locations->locations[0]->getPlace()->getAddress()->getCountryCode());
    }
}
