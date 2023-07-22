<?php

declare(strict_types=1);

namespace Drupal\Tests\dhl_location_finder\Entity;

use Drupal\dhl_location_finder\Entity\OpeningHours;
use Drupal\Tests\UnitTestCase;

class OpeningHoursTest extends UnitTestCase
{
    public function testCreateOpeningHoursEntity(): void
    {
        $openingHours = (new OpeningHours())
            ->setOpens('08:00:00')
            ->setCloses('17:00:00')
            ->setDayOfWeek('http://schema.org/Monday')
        ;

        $this->assertEquals('08:00:00', $openingHours->getOpens());
        $this->assertEquals('17:00:00', $openingHours->getCloses());
        $this->assertEquals('http://schema.org/Monday', $openingHours->getDayOfWeek());
    }
}
