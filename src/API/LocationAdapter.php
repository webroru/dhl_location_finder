<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\API;

use Drupal\dhl_location_finder\Entity\Address;
use Drupal\dhl_location_finder\Entity\Location;
use Drupal\dhl_location_finder\Entity\OpeningHours;

class LocationAdapter extends Location
{
    public function __construct(Entity\Location $location)
    {
        $this->setName($location->getName());
        $this->setAddress(
            (new Address())
                ->setStreetAddress($location->getPlace()->getAddress()->getStreetAddress())
                ->setCountryCode($location->getPlace()->getAddress()->getCountryCode())
                ->setPostalCode($location->getPlace()->getAddress()->getPostalCode())
                ->setAddressLocality($location->getPlace()->getAddress()->getAddressLocality())
        );
        $this->setOpeningHours(
            (new OpeningHours())
                ->setMonday($this->getOpeningHoursByDay('Monday', $location->getOpeningHours()))
                ->setTuesday($this->getOpeningHoursByDay('Tuesday', $location->getOpeningHours()))
                ->setWednesday($this->getOpeningHoursByDay('Wednesday', $location->getOpeningHours()))
                ->setThursday($this->getOpeningHoursByDay('Thursday', $location->getOpeningHours()))
                ->setFriday($this->getOpeningHoursByDay('Friday', $location->getOpeningHours()))
                ->setSaturday($this->getOpeningHoursByDay('Saturday', $location->getOpeningHours()))
                ->setSunday($this->getOpeningHoursByDay('Sunday', $location->getOpeningHours()))
        );
    }

    /**
     * @param Entity\OpeningHours[] $openingHours
     */
    private function getOpeningHoursByDay(?string $day, array $openingHours): ?string
    {
        $result = null;

        foreach ($openingHours as $openingHour) {
            if (!str_contains($openingHour->getDayOfWeek(), $day)) {
                continue;
            }
            $result = $result ? "$result; " : $result;
            $result .= "{$openingHour->getOpens()} - {$openingHour->getCloses()}";
        }

        return $result;
    }
}
