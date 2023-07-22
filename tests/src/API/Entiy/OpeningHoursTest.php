<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\API;

use Drupal\dhl_location_finder\API\Entity\OpeningHours;
use Drupal\Tests\UnitTestCase;

class OpeningHoursTest extends UnitTestCase
{
    public function testCreateLocationDTO(): void
    {
        $data = [
            'opens' => '08:00:00',
            'closes' => '17:00:00',
            'dayOfWeek' => 'http://schema.org/Monday'
          ];
        $openingHours = new OpeningHours(...$data);

        $this->assertEquals('08:00:00', $openingHours->getOpens());
        $this->assertEquals('17:00:00', $openingHours->getCloses());
        $this->assertEquals('http://schema.org/Monday', $openingHours->getDayOfWeek());
    }
}
