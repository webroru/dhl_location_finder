<?php

declare(strict_types=1);


namespace Drupal\dhl_location_finder\API;

interface LocationProviderInterface
{
    public function findByAddress(string $countryCode, string $addressLocality, string $postalCode): array;
}
