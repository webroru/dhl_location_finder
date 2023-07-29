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
            ->setMonday('00:00:00 - 23:59:00')
            ->setTuesday('00:00:00 - 23:59:00')
            ->setWednesday('00:00:00 - 23:59:00')
            ->setThursday('00:00:00 - 23:59:00')
            ->setFriday('00:00:00 - 23:59:00')
            ->setSaturday('00:00:00 - 23:59:00')
            ->setSunday('00:00:00 - 23:59:00')
        ;

        $this->assertEquals('00:00:00 - 23:59:00', $openingHours->getMonday());
        $this->assertEquals('00:00:00 - 23:59:00', $openingHours->getSunday());
    }
}
