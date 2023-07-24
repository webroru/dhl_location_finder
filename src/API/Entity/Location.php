<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\API\Entity;

class Location
{
    private string $name;
    private Place $place;
    /** @var OpeningHours[] */
    private array $openingHours;

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

    public function getOpeningHours(): array
    {
        return $this->openingHours;
    }

    public function setOpeningHours(array $openingHours): self
    {
        $this->openingHours = $openingHours;
        return $this;
    }
}
