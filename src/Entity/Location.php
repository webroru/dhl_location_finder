<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\Entity;

class Location
{
    private string $name;
    private Address $address;
    private OpeningHours $openingHours;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getOpeningHours(): OpeningHours
    {
        return $this->openingHours;
    }

    public function setOpeningHours(OpeningHours $openingHours): self
    {
        $this->openingHours = $openingHours;
        return $this;
    }
}
