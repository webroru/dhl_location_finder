<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\API\Entity;

class Location
{
    public function __construct(
        private string $name,
        private Place $place,
        private array $openingHours,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPlace(): Place
    {
        return $this->place;
    }

    public function setPlace(Place $place): self
    {
        $this->place = $place;
        return $this;
    }

    /**
     * @return OpeningHours[]
     */
    public function getOpeningHours(): array
    {
        return $this->openingHours;
    }

    /**
     * @param OpeningHours[] $openingHours
     * @return $this
     */
    public function setOpeningHours(array $openingHours): self
    {
        $this->openingHours = $openingHours;
        return $this;
    }
}
