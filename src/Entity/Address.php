<?php

declare(strict_types=1);

namespace Drupal\dhl_location_finder\Entity;

class Address
{
    private string $countryCode;
    private string $postalCode;
    private string $addressLocality;
    private string $streetAddress;

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): Address
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): Address
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getAddressLocality(): string
    {
        return $this->addressLocality;
    }

    public function setAddressLocality(string $addressLocality): Address
    {
        $this->addressLocality = $addressLocality;
        return $this;
    }

    public function getStreetAddress(): string
    {
        return $this->streetAddress;
    }

    public function setStreetAddress(string $streetAddress): Address
    {
        $this->streetAddress = $streetAddress;
        return $this;
    }
}
