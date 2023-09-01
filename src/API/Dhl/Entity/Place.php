<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\API\Dhl\Entity;

class Place
{
    private Address $address;

    public function getAddress(): Address
    {
        return $this->address;
    }
    public function setAddress(Address $address): self
    {
        $this->address = $address;
        return $this;
    }
}
